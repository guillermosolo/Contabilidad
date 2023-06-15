<?php

namespace App\Http\Controllers\Planillas;

use App\Exports\Planilla\ReporteEstadisticoExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Planillas\ValidacionLibroSalarios;
use App\Http\Requests\Planillas\ValidacionPrestacionLaboral;
use App\Http\Requests\Planillas\ValidacionReportes;
use App\Models\Parametros\Empresa;
use App\Models\Planilla\DetallePlanilla;
use App\Models\Planilla\Empleado;
use App\Models\Planilla\Planilla;
use App\Models\Planilla\TiposDesc;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReporteLibroSalariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function create()
    {
        return view('planillas.reportes.libro-salarios.crear');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ValidacionPrestacionLaboral $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function store(ValidacionLibroSalarios $request)
    {
        $dataRequest = $request->validated();
        $empleado = Empleado::find($dataRequest['empleado']);
        $datas = $this->getReporte($dataRequest);
        $dataEmpleado = $datas['empleadoData'];
        $totales = $datas['totales'];
        $name = 'LIBRO DE SALARIO DE ' . $empleado->getNombreCompleto($dataRequest['empleado']) . ' DE ' . Empresa::find($dataRequest['empresa'])->emp_siglas . '.pdf';
        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('planillas.reportes.libro-salarios.exports.pdf', compact('dataEmpleado', 'totales','empleado'))->setPaper('letter', 'landscape');
        return $pdf->download($name);

//            return  view('planillas.reportes.estadistico.index',compact('datas'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function getReporte($data): array
    {
        $detalles = DB::table('detalleplanilla as d')
            ->join('tipodesc as t', 't.tipd_id', '=', 'd.dept_tipo')
            ->join('planilla as p', 'p.pla_id', '=', 'd.detp_planilla')
            ->where('dept_empleado', $data['empleado'])
            ->where('p.pla_tipo', '=', 'O')
            ->select('d.detp_planilla', 'd.dept_empleado', 'd.dept_monto', 't.tipd_clase', 't.tipd_forma', 't.tipd_descripcion')
            ->get();

        $planillas = array_unique($detalles->pluck('detp_planilla')->toArray());
        $empleadosArray = collect();
        foreach ($planillas as $pla) {
            $plaObject = new Planilla();
            $detalle = $detalles->where('detp_planilla', $pla);
            $planillaDetalle = Planilla::find($pla);
            $salarioBase = $detalle->firstWhere('tipd_clase', '=', 'S')->dept_monto;
            $diasLab = $detalle->firstWhere('tipd_clase', '=', 'L')->dept_monto;
            $septimo = floor(intval($diasLab) / 6);
            $diasLab = $diasLab - $septimo;
            $horasExtra = $detalle->firstWhere('tipd_clase', '=', 'E')->dept_monto;
            $horasOrdinales = $detalle->firstWhere('tipd_clase', '=', 'O')->dept_monto;
            $bonificaciones = $detalle->where('tipd_clase', '=', 'B');
            $bonificacion_incentivo = $bonificaciones->firstWhere('tipd_descripcion', '=', 'BONIFICACION INCENTIVO')->dept_monto;
            $bonificacion = $bonificaciones->sum('dept_monto');
            $prestamos = $detalle->filter(function ($item) {
                return false !== stristr(strtoupper($item->tipd_descripcion), 'PRESTAMO');
            })->sum('dept_monto');
            $anticipos = $detalle->filter(function ($item) {
                return false !== stristr(strtoupper($item->tipd_descripcion), 'ANTICIPO');
            })->sum('dept_monto');
            $otros = ($detalle->sum('dept_monto') - ($salarioBase + $bonificacion + $prestamos + $anticipos + $diasLab + $septimo + $horasExtra + $horasOrdinales));
            $valorHoraOrdinaria = $plaObject->getValorOrdinaria($salarioBase);
            $sueldoOrdinarioExtra = $plaObject->getSueldoOrdinarioExtra($valorHoraOrdinaria, $horasOrdinales);
            $sueldoOrdinaro = $plaObject->getSueldoOrdinario($salarioBase, $diasLab, $sueldoOrdinarioExtra);
            $valorHoraExtra = $plaObject->getValorHoraExtra($salarioBase);
            $sueldoExtra = $plaObject->getSueldoExtra($valorHoraExtra, $horasExtra);
            $septimos = round(($septimo * ($salarioBase / 30)), 2);
            $sueldoTotal = $plaObject->getSueldoTotal($sueldoExtra, $sueldoOrdinaro) + $septimos;
            $igss = $plaObject->getIgss($sueldoTotal);
            $totalDescuentos = $igss + $prestamos + $anticipos + $otros;
            $deducciones = $prestamos + $anticipos + $otros;
            $totalDeducciones = $sueldoTotal - $igss-$deducciones;
            $bono = $this->getBonos($data['empleado'], $planillaDetalle->pla_fin->format('Y-m-d'));
            $empleadoItem = [
                'no_planilla' => $pla,
                'periodo' => 'DEL ' . $planillaDetalle->pla_inicio->format('d/m/Y') . ' AL ' . $planillaDetalle->pla_fin->format('d/m/Y'),
                'sueldoMensual' => $salarioBase,
                'diasLab' => intval($diasLab) + $septimo,
                'horasOrdinales' => intval($horasOrdinales),
                'horasExtras' => intval($horasExtra),
                'sueldoOrdinario' => $sueldoOrdinaro,
                'sueldoExtra' => $sueldoExtra,
                'septimos' => $septimos,
                'otros_salarios' => $bonificacion - $bonificacion_incentivo,
                'sueldoTotal' => $sueldoTotal,
                'igss' => $igss,
                'otras_deducciones' => $deducciones,
                'total_deducciones' => $totalDeducciones,
                'bonos' => $bono,
                'subtotal' => $sueldoOrdinaro + $bonificacion + $sueldoExtra + $septimos,
                'bonificacion_incentivo' => $bonificacion_incentivo,
                'sueldoLiquido' => round(($sueldoOrdinaro + $sueldoExtra + $septimos + $bono) - $totalDescuentos + $bonificacion + $bono, 2),
            ];
            $empleadosArray->push($empleadoItem);
        };
        return ['empleadoData' => $empleadosArray->toArray(), 'totales' => $this->getTotales($empleadosArray)];
    }

    public function getTotales($empleado): array
    {
        $totales = ['sueldoMensual' => 0, 'diasLab' => 0, 'horasOrdinales' => 0, 'horasExtras' => 0, 'sueldoOrdinario' => 0, 'sueldoExtra' => 0, 'septimos' => 0, 'otros_salarios' => 0, 'sueldoTotal' => 0, 'igss' => 0, 'otras_deducciones' => 0, 'total_deducciones' => 0, 'bonos' => 0, 'subtotal' => 0, 'bonificacion_incentivo' => 0, 'sueldoLiquido' => 0,];
        foreach($empleado as $emp){
            $totales['sueldoMensual']+= $emp['sueldoMensual'];
            $totales['diasLab']+= $emp['diasLab'];
            $totales['horasOrdinales']+= $emp['sueldoMensual'];
            $totales['horasExtras']+= $emp['horasExtras'];
            $totales['sueldoOrdinario']+= $emp['sueldoOrdinario'];
            $totales['sueldoExtra']+= $emp['sueldoExtra'];
            $totales['sueldoMensual']+= $emp['sueldoMensual'];
            $totales['septimos']+= $emp['septimos'];
            $totales['otros_salarios']+= $emp['otros_salarios'];
            $totales['sueldoTotal']+= $emp['sueldoTotal'];
            $totales['igss']+= $emp['igss'];
            $totales['otras_deducciones']+= $emp['otras_deducciones'];
            $totales['total_deducciones']+= $emp['total_deducciones'];
            $totales['bonos']+= $emp['bonos'];
            $totales['subtotal']+= $emp['subtotal'];
            $totales['bonificacion_incentivo']+= $emp['bonificacion_incentivo'];
            $totales['sueldoLiquido']+= $emp['sueldoLiquido'];
        }

        return $totales;
    }

    public function getBonos($empleado, $fecha)
    {
        $bono14 = DB::table('detalleplanilla as d')
            ->join('planilla as p', 'p.pla_id', '=', 'd.detp_planilla')
            ->where('dept_empleado', $empleado)
            ->where('p.pla_tipo', '=', 'N')
            ->where('p.pla_fin', '=', $fecha)
            ->sum('d.dept_monto');
        $aguinaldo = DB::table('detalleplanilla as d')
            ->join('planilla as p', 'p.pla_id', '=', 'd.detp_planilla')
            ->where('dept_empleado', $empleado)
            ->where('p.pla_tipo', '=', 'A')
            ->where('p.pla_fin', $fecha)
            ->sum('d.dept_monto');
        return $bono14 + $aguinaldo;
    }
}
