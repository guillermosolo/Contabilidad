<?php

namespace App\Http\Controllers\Planillas;

use App\Exports\Planilla\PlanillaEventualExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Planillas\ValidacionPlanillaEventual;
use App\Models\Planilla\DescuentoEventual;
use App\Models\Planilla\DetallePlanilla;
use App\Models\Planilla\DetalleTurnos;
use App\Models\Planilla\Empleado;
use App\Models\Planilla\Planilla;
use App\Models\Planilla\ReporteTurnos;
use App\Models\Planilla\ReporteTurnosBarcos;
use App\Models\Planilla\TiposDesc;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

use Str;

class PlanillaEventualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $pla = new Planilla();
        $datas = $pla->getPlanilla('E');
        return view('planillas.generacion.eventual.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {

        return view('planillas.generacion.eventual.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ValidacionPlanillaEventual $request)
    {
        $data = $request->validated();
        [$inicio, $fin] = explode(' / ', $data['pla_fecha']);
        $data['pla_inicio'] = Carbon::parse(Carbon::createFromFormat('d/m/Y', $inicio))->format('Y-m-d H:i:s');
        $data['pla_fin'] = Carbon::parse(Carbon::createFromFormat('d/m/Y', $fin))->format('Y-m-d H:i:s');
        $data['pla_liquidacion'] = 0;
        Planilla::create($data);
        return redirect()->route('planillas-eventual')->with('mensaje', 'Planilla Eventual Creada con exito.');

    }

    public function show($id)
    {
        $tipos = $this->getTipos();
        $detalles = collect(DetallePlanilla::where('detp_planilla', $id)->select('detp_planilla', 'dept_empleado', 'dept_tipo', 'dept_monto')->get()->toArray());
        $empleados = array_unique($detalles->pluck('dept_empleado')->toArray());
        $result = $this->calcPlanilla($empleados, $detalles, $tipos, true);
        $planilla = Planilla::find($id);
        return view('planillas.generacion.eventual.show', ['planilla' => $planilla, 'datas' => $result['datas'], 'totales' => $result['totales']]);
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
        return DB::transaction(function () use ($id) {
            try {
                DetalleTurnos::with('ReporteTurnos')
                    ->join('reporteturnos as r', 'r.rept_id', '=', 'dett_reporte')
                    ->where('r.rept_planilla', '=', $id)->delete();
                ReporteTurnos::where('rept_planilla', $id)->delete();
                ReporteTurnosBarcos::where('retb_planilla', $id)->delete();
                DetallePlanilla::where('detp_planilla', $id)->delete();
                Planilla::where('pla_id', $id)->delete();
            } catch (Exception $e) {
                return back()->withErrors(['catch', $e->errorInfo]);
            }
            return back()->with('mensaje', 'Planilla eliminada con exito.');
        });
    }


    public function getPlanillasTurnos(Request $request, $empresa, $terminal, $fecha)
    {

        $fecha = date("Y-m-d", substr($fecha, 0, 10));
        if ($request->ajax()) {
            $pla = new Planilla();

            $datas = $pla->getPlanillaEmpresa('E', $empresa, $terminal, $fecha);

            return response()->json($datas);
        } else {
            abort(404);
        }
    }

    public function getPlanillasBarcos(Request $request, $empresa, $terminal, $fecha)
    {
        [$from, $to] = explode(',', $fecha);
        $from = date("Y-m-d", substr($from, 0, 10));
        $to = date("Y-m-d", substr($to, 0, 10));
        if ($request->ajax()) {
            $datas = Planilla::where('pla_tipo', '=', 'E')
                ->where('pla_empresa', $empresa)
                ->where('pla_terminal', $terminal)
                ->where('pla_inicio', '<=', $from)
                ->where('pla_fin', '>=', $to)
                ->get();
            return response()->json($datas);
        } else {
            abort(404);
        }
    }

    public function generate(Request $request, Planilla $planilla)
    {
        try {
            $data = $this->validarReporte($request, $planilla->pla_id);
            $detalles = collect();
            $tipos = $this->getTipos();
            foreach ($data as $item) {
                $empleado = Empleado::find($item['empleado']);
                $detalles->push(['detp_planilla' => $planilla->pla_id, 'dept_empleado' => $item['empleado'], 'dept_tipo' => $tipos['salario'], 'dept_monto' => $empleado->empl_salario]);
                $detalles->push(['detp_planilla' => $planilla->pla_id, 'dept_empleado' => $item['empleado'], 'dept_tipo' => $tipos['extra'], 'dept_monto' => $item['extras']]);
                $detalles->push(['detp_planilla' => $planilla->pla_id, 'dept_empleado' => $item['empleado'], 'dept_tipo' => $tipos['ordinaria'], 'dept_monto' => $item['ordinal']]);
                $detalles->push(['detp_planilla' => $planilla->pla_id, 'dept_empleado' => $item['empleado'], 'dept_tipo' => $tipos['turno'], 'dept_monto' => $item['turnos']]);
                $detalles->push(['detp_planilla' => $planilla->pla_id, 'dept_empleado' => $item['empleado'], 'dept_tipo' => $tipos['septimo'], 'dept_monto' => $this->calcSeptimo($item['turnos'])]);
                $detalles->push(['detp_planilla' => $planilla->pla_id, 'dept_empleado' => $item['empleado'], 'dept_tipo' => $tipos['descuento'], 'dept_monto' => $this->calcDescuento($item['empleado'], false)]);
            }
            $request->session()->put(['dataDetalles' => $detalles]);

            $result = $this->calcPlanilla($request->session()->get('dataEmpleados'), $detalles, $tipos, false);
            return view('planillas.generacion.eventual.generacion', ['datas' => $result['datas'], 'totales' => $result['totales'], 'id' => $planilla->pla_id]);
        } catch (Exception $e) {
            return redirect('planillas/generacion/eventual')->withErrors(['catch2', $e->getMessage()]);
        }
    }

    public function insertPlanilla(Request $request)
    {
        if ($request->session()->has('dataDetalles')) {
            try {
                DB::transaction(function () use ($request) {
                    foreach ($request->session()->get('dataDetalles') as $item) {
                        DetallePlanilla::create($item);
                    }
                    $this->insertDescuento($request->session()->get('dataEmpleados'));
                });
                return redirect()->route('planillas-eventual')->with('mensaje', 'Planilla Eventual Creada con exito.');
            } catch (Exception $e) {
                return redirect('planillas/generacion/eventual')->withErrors(['catch2', $e->getMessage()]);
            }
        } else {
            return redirect()->route('planillas-eventual')->withErrors('A ocurrido un error.');
        }

    }

    private function insertDescuento($data)
    {
        foreach ($data as $item) {
            $this->calcDescuento($item, true);
        }
    }

    private function validarReporte($request, $id): \Illuminate\Support\Collection
    {
        $reporteBarcos = DB::table('reporteturnosbarcos')->where('retb_planilla', $id)
            ->select('retb_turnos as turnos', 'retb_extras as extras', 'retb_ordinales as ordinal', 'retb_empleado as empleado')
            ->get();
        $reporteTurnos = DB::table('detalleturnos as d')
            ->join('reporteturnos as r', 'r.rept_id', '=', 'd.dett_reporte')
            ->select('dett_turnos as turnos', 'dett_extras as extras', 'dett_ordinales as ordinal', 'dett_empleado as empleado')
            ->where('r.rept_planilla', $id)
            ->get();

        $empleados = array_unique(array_merge($reporteBarcos->pluck('empleado')->toArray(), $reporteTurnos->pluck('empleado')->toArray()));
        $reportes = array_merge($reporteBarcos->toArray(), $reporteTurnos->toArray());
        $request->session()->put(['dataEmpleados' => $empleados]);
        if (count($reportes) == 0) {
            throw ValidationException::withMessages(['No existe ningun reporte ingresado en el sistema']);
        }
        $result = collect();
        foreach ($empleados as $emp) {
            $pre = ['empleado' => $emp, 'turnos' => 0, 'extras' => 0, 'ordinal' => 0];
            foreach ($reportes as $reporte) {
                if ($reporte->empleado == $emp) {
                    $pre['turnos'] += $reporte->turnos;
                    $pre['extras'] += $reporte->extras;
                    $pre['ordinal'] += $reporte->ordinal;
                }
            }
            $result->push($pre);
        }

        return $result;
    }

    private function getTipos(): array
    {
        return [
            'salario' => TiposDesc::where('tipd_clase', '=', 'S')->first()->tipd_id,
            'extra' => TiposDesc::where('tipd_clase', '=', 'E')->first()->tipd_id,
            'ordinaria' => TiposDesc::where('tipd_clase', '=', 'O')->first()->tipd_id,
            'turno' => TiposDesc::where('tipd_clase', '=', 'T')->first()->tipd_id,
            'septimo' => TiposDesc::where('tipd_clase', '=', 'P')->first()->tipd_id,
            'descuento' => TiposDesc::where('tipd_clase', '=', 'U')->first()->tipd_id,
        ];
    }

    private function calcDescuento($empleado, $save): float
    {
        $totalDescuento = 0.00;
        $descuentos = DescuentoEventual::where('dee_empleado', $empleado)->where('dee_saldo', '>', 0)->get();
        foreach ($descuentos ?? [] as $descuento) {
            if ($descuento->dee_saldo >= $descuento->dee_monto) {
                if ($save) {
                    $descuento->decrement('dee_saldo', $descuento->dee_monto);
                }
                $totalDescuento += $descuento->dee_monto;
            } else {
                $submonto = $descuento->dee_monto - $descuento->dee_saldo;
                if ($save) {
                    $descuento->update(['dee_saldo' => 0]);
                }
                $totalDescuento += $submonto;
            }
        }
        return round($totalDescuento, 2);
    }

    private function calcPlanilla($dataEmpleados, $detalles, $tipos, $save)
    {
        $datas = collect();
        foreach ($dataEmpleados as $empleado) {
            $plaObject = new Planilla();
            $empObject = Empleado::find($empleado);
            $detalleEmpleado = $detalles->where('dept_empleado', $empleado);
            $ordinaria = $detalleEmpleado->firstWhere('dept_tipo', $tipos['ordinaria'])['dept_monto'];
            $turnos = $detalleEmpleado->firstWhere('dept_tipo', $tipos['turno'])['dept_monto'];
            $extra = $detalleEmpleado->firstWhere('dept_tipo', $tipos['extra'])['dept_monto'];
            $salario = $detalleEmpleado->firstWhere('dept_tipo', $tipos['salario'])['dept_monto'];
            $septimo = $detalleEmpleado->firstWhere('dept_tipo', $tipos['septimo'])['dept_monto'];
            $descuento = $detalleEmpleado->firstWhere('dept_tipo', $tipos['descuento'])['dept_monto'];
            $vhoraextra = round((($salario / 8) * 1.5), 2);
            $vhoraordinaria = round(($salario / 8), 2);
            $totalOrdinaria = round(($salario * ($turnos + $septimo)) + ($ordinaria * $vhoraordinaria), 2);
            $totalExtra = round($vhoraextra * $extra, 2);
            $bonificacion = round(($turnos + $septimo) * (250 / 30), 2);
            $totalSeptimo = round($septimo * $salario, 2);
            $subtotal = round($totalExtra + $totalOrdinaria, 2);
            $dataPre = [
                'diasLab' => intval($septimo + $turnos),
                'codigoEmpleado' => $empObject->empl_codigo,
                'puesto' => $empObject->empl_ocupacion,
                'empleado' => $empleado,
                'dpi' => $empObject->empl_docID,
                'nombre' => $empObject->getNombreCompleto($empleado),
                'turno' => $turnos,
                'salario' => $salario,
                'vHoraExtra' => $vhoraextra,
                'horaExtra' => $extra,
                'horaOrdinaria' => $ordinaria,
                'totalOrdinaria' => $totalOrdinaria,
                'totalExtra' => $totalExtra,
                'bonificacion' => $bonificacion,
                'totalSeptimo' => $totalSeptimo,
                'subtotal' => $subtotal,
            ];
            if ($save) {
                $igss = $plaObject->getIgss($subtotal);
                $total = round($subtotal + $bonificacion, 2);
                $totalIngresos = round($total - $igss - $descuento, 2);
                $aguinaldo = round($totalOrdinaria * 0.0833, 2);
                $bono14 = round($totalOrdinaria * 0.0833, 2);
                $vacaciones = round($subtotal * 0.0416, 2);
                $indemnizacion = round($subtotal * 0.0971, 2);
                $igssPatronal = round($subtotal * (12.67 / 100), 2);
                $totalRecibido = round($totalIngresos + $aguinaldo + $bono14 + $vacaciones + $indemnizacion, 2);
                $dataPost = [
                    'igss' => $igss,
                    'total' => $total,
                    'descuentos' => $descuento,
                    'totalIngresos' => $totalIngresos,
                    'aguinaldo' => $aguinaldo,
                    'bono14' => $bono14,
                    'vacaciones' => $vacaciones,
                    'indemnizacion' => $indemnizacion,
                    'igssPatronal' => $igssPatronal,
                    'totalRecibido' => $totalRecibido
                ];
            } else {
                $dataPost = [];
            }
            $data = array_merge($dataPre, $dataPost);
            $datas->push($data);
        }
        return ['datas' => $datas, 'totales' => $this->calcTotales($datas, $save)];
    }

    private function calcTotales($detalle, $save)
    {
        $totalesPre = ['turno' => 0, 'salario' => 0, 'vHoraExtra' => 0, 'totalSeptimo' => 0, 'horaExtra' => 0, 'horaOrdinaria' => 0, 'totalOrdinaria' => 0, 'totalExtra' => 0, 'bonificacion' => 0,
            'subtotal' => 0];
        if ($save) {
            $totalesPost = ['igss' => 0, 'total' => 0, 'descuentos' => 0, 'totalIngresos' => 0, 'aguinaldo' => 0, 'bono14' => 0, 'vacaciones' => 0, 'indemnizacion' => 0,
                'igssPatronal' => 0, 'totalRecibido' => 0];
        } else {
            $totalesPost = [];
        }
        $totales = array_merge($totalesPre, $totalesPost);
        foreach ($detalle as $item) {
            $totales['turno'] += $item['turno'];
            $totales['salario'] += $item['salario'];
            $totales['vHoraExtra'] += $item['vHoraExtra'];
            $totales['horaExtra'] += $item['horaExtra'];
            $totales['totalSeptimo'] += $item['totalSeptimo'];
            $totales['horaOrdinaria'] += $item['horaOrdinaria'];
            $totales['totalOrdinaria'] += $item['totalOrdinaria'];
            $totales['totalExtra'] += $item['totalExtra'];
            $totales['bonificacion'] += $item['bonificacion'];
            $totales['subtotal'] += $item['subtotal'];
            if ($save) {
                $totales['igss'] += $item['igss'];
                $totales['total'] += $item['total'];
                $totales['descuentos'] += $item['descuentos'];
                $totales['totalIngresos'] += $item['totalIngresos'];
                $totales['aguinaldo'] += $item['aguinaldo'];
                $totales['bono14'] += $item['bono14'];
                $totales['vacaciones'] += $item['vacaciones'];
                $totales['indemnizacion'] += $item['indemnizacion'];
                $totales['igssPatronal'] += $item['igssPatronal'];
                $totales['totalRecibido'] += $item['totalRecibido'];
            }

        }
        return $totales;
    }

    private function calcSeptimo($turnos)
    {
        $subtotal = $turnos / 6;
        return floor($subtotal);
    }

    public function septimoSet(Request $request, $empleado, $planilla, $tipo)
    {
        if ($request->ajax()) {
            $data = $request->session()->get('dataDetalles');
            $num = $tipo ? +1 : -1;
            $septimo = TiposDesc::where('tipd_clase', '=', 'P')->first()->tipd_id;
            foreach ($data as $key => $item) {
                if ($item['dept_tipo'] == $septimo && $item['dept_empleado'] == $empleado) {
                    $save = ['detp_planilla' => $planilla, 'dept_empleado' => $empleado, 'dept_tipo' => $septimo, 'dept_monto' => ($item['dept_monto'] + $num)];
                    unset($data[$key]);
                    $data->push($save);
                }
            }
            $request->session()->put('dataDetalles', $data);
        } else {
            abort(404);
        }


    }

    public function exportarExcel($id): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $tipos = $this->getTipos();
        $detalles = collect(DetallePlanilla::where('detp_planilla', $id)->select('detp_planilla', 'dept_empleado', 'dept_tipo', 'dept_monto')->get()->toArray());
        $empleados = array_unique($detalles->pluck('dept_empleado')->toArray());
        $planilla = Planilla::find($id);
        $name = $planilla->pla_descripcion . ' DEl ' . $planilla->pla_inicio->format('d') . ' AL ' . $planilla->pla_fin->format('d') . ' DE ' . Str::nombreMes(intval($planilla->pla_fin->format('m'))) . ' DEl  ' . $planilla->pla_fin->format('Y') . '.xlsx';
        return Excel::download(new PlanillaEventualExport($this->calcPlanilla($empleados, $detalles, $tipos, true)), $name);
    }

    public function exportarPDF($id)
    {
        $tipos = $this->getTipos();
        $detalles = collect(DetallePlanilla::where('detp_planilla', $id)->select('detp_planilla', 'dept_empleado', 'dept_tipo', 'dept_monto')->get()->toArray());
        $empleados = array_unique($detalles->pluck('dept_empleado')->toArray());
        $planilla = Planilla::find($id);
        $result = $this->calcPlanilla($empleados, $detalles, $tipos, true);
        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('planillas.generacion.exports.eventual.pdf', ['planilla' => $planilla, 'datas' => $result['datas'], 'totales' => $result['totales']])->setPaper('letter', 'landscape');
        $name = "Planilla de " . ' DEl ' . $planilla->pla_inicio->format('d') . ' AL ' . $planilla->pla_fin->format('d') . ' DE ' . Str::nombreMes(intval($planilla->pla_fin->format('m'))) . ' DEl  ' . $planilla->pla_fin->format('Y') . '.pdf';
        return $pdf->download($name);
    }


    public function imprimirFiniquito($id)
    {

        $tipos = $this->getTipos();
        $detalles = collect(DetallePlanilla::where('detp_planilla', $id)->select('detp_planilla', 'dept_empleado', 'dept_tipo', 'dept_monto')->get()->toArray());
        $empleados = array_unique($detalles->pluck('dept_empleado')->toArray());
        $planilla = Planilla::find($id);
        $result = $this->calcPlanilla($empleados, $detalles, $tipos, true);
        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('planillas.generacion.exports.eventual.finiquito', ['planilla' => $planilla, 'datas' => $result['datas']])->setPaper('letter', 'portrait');
        $name = "Finiquito de" . ' DEl ' . $planilla->pla_inicio->format('d') . ' AL ' . $planilla->pla_fin->format('d') . ' DE ' . Str::nombreMes(intval($planilla->pla_fin->format('m'))) . ' DEl  ' . $planilla->pla_fin->format('Y') . '.pdf';
        return $pdf->download($name);

    }
}
