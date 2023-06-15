<?php

namespace App\Http\Controllers\Planillas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Planillas\ValidacionPrestacionLaboral;
use App\Models\Planilla\Empleado;
use App\Models\Planilla\Planilla;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class PrestacionesLaboralesController extends Controller
{

    public function index()
    {
        return view('planillas.prestacion-laboral.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\Http\Response|View
     */
    public function create()
    {
        return view('planillas.prestacion-laboral.crear');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ValidacionPrestacionLaboral $request
     * @return Factory|Application|View
     */
    public function store(ValidacionPrestacionLaboral $request)
    {
        $data = $request->validated();
        $data['fecha'] = Carbon::parse(Carbon::createFromFormat('d/m/Y', $data['fecha']));
        $datas = $this->getPrestaciones($data['empleado'], $data['fecha'], $data['vacaciones'], $data['motivo'], $data['descuentos']);
        return view('planillas.prestacion-laboral.index', compact('datas'));
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

    private function getPrestaciones($empleado, $fecha, $vacaciones, $motivo,$descuentos)
    {
        $empleado = Empleado::find($empleado);
        $salarioMasExtraordinario = $empleado->getSalarioPromedio($empleado->empl_id, $fecha);
        $salario = $empleado->empl_salario;
        $fechaInicioEmpleado = Carbon::parse($empleado->empl_inicio);
        $diasTrabajados = $fecha->diffInDays($fechaInicioEmpleado)+1;
        $year = intval($fecha->format('Y'));
        $planilla = new Planilla();

        return collect([
            'empresa' => $empleado->Empresa->emp_nombre,
            'motivo' => $motivo == '1' ? 'Despido' : 'Renuncia',
            'nombre' => $empleado->getNombreCompleto($empleado->empl_id),
            'dpi' => $empleado->empl_docID,
            'codigo' => $empleado->empl_codigo,
            'salario' => $salario,
            'salarioPromedio' => $salarioMasExtraordinario,
            'inicio_empleado' => Carbon::parse($empleado->empl_inicio)->format('d/m/Y'),
            'fecha_calculo' => $fecha->format('d/m/Y'),
            'quincena' => $this->calcQuincena($salarioMasExtraordinario, $fecha),
            'indemnizacion' => $this->calcIndemnizacion($salarioMasExtraordinario, $diasTrabajados, $motivo, $fechaInicioEmpleado),
            'vacaciones' => $this->calcVacaciones($salario, $vacaciones),
            'bono14' => $planilla->calcBonificacionesAB($salario, $fechaInicioEmpleado, $year, 'N', $fecha),
            'aguinaldo' => $planilla->calcBonificacionesAB($salario, $fechaInicioEmpleado, $year, 'A', $fecha),
            'descuentos'=>$descuentos
        ]);
    }

    private function calcIndemnizacion($salario, $diasTrabajados, $motivo, $fechaInicioEmpleado)
    {
        if ($motivo == "1") {
            $sueldoPromedio = $salario / 6;
            $subtotal = ($sueldoPromedio + $salario) / 365;
            $result = ['monto' => round(($subtotal * $diasTrabajados), 2), 'fecha' => $fechaInicioEmpleado, 'dias' => $diasTrabajados];
        } else {
            $result = ['monto' => 0, 'fecha' => '-', 'dias' => $diasTrabajados];
        }
        return $result;
    }

    private function calcVacaciones($salario, $vacaciones)
    {

        $sueldoPromedio = $salario / 30;
        return ['monto' => round(($sueldoPromedio * $vacaciones), 2), 'dias' => $vacaciones];
    }

    private function calcQuincena($salario, $fecha)
    {
        if (intval($fecha->format('d')) >= 16) {
            $fechaInicial = now()->months(intval($fecha->format('m')))->years($fecha->format('Y'))->days(16);
        } else {
            $fechaInicial = now()->months(intval($fecha->format('m')))->years($fecha->format('Y'))->days(1);
        }
        $diasPendientes = $fechaInicial->diffInDays($fecha) + 1;
        $sueldoPromedio = $salario / 30;
        $subtotal = $sueldoPromedio * $diasPendientes;
        return ['monto' => round($subtotal, 2), 'dias' => $diasPendientes, 'fecha' => $fechaInicial];
    }

    public function exportarPDF($datas)
    {
        $data = decrypt($datas);
        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('planillas.prestacion-laboral.exports.pdf', compact('data'))->setPaper('letter', 'portrait');
        $name = 'PRESTACION LABORAL DE ' . strtoupper($data['nombre']) . ' DE ' . Carbon::parse(Carbon::createFromFormat('d/m/Y', $data['inicio_empleado']))->format('d-m-Y') . ' HASTA ' . Carbon::parse(Carbon::createFromFormat('d/m/Y', $data['fecha_calculo']))->format('d-m-Y') . '.pdf';
        return $pdf->download($name);
    }
}
