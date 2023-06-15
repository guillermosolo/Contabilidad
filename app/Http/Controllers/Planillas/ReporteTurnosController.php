<?php

namespace App\Http\Controllers\Planillas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Planillas\ValidacionDetalleTurnos;
use App\Http\Requests\Planillas\ValidacionReportesTurnos;
use App\Http\Requests\Planillas\ValidacionValidarReporteTurnos;
use App\Models\Planilla\ControlSeguridad;
use App\Models\Planilla\DetallePlanilla;
use App\Models\Planilla\DetalleTurnos;
use App\Models\Planilla\Empleado;
use App\Models\Planilla\ReporteTurnos;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteTurnosController extends Controller
{

    public function index(Request $request)
    {
        [$from, $to] = explode(' / ', $request->get('date') ?: ' / ');
        $from = Carbon::createFromFormat('d/m/Y', $from ?: now()->format('d/m/Y'));
        $to = Carbon::createFromFormat('d/m/Y', $to ?: now()->format('d/m/Y'));
        $query = ReporteTurnos::with('Planilla')->join('planilla as p','p.pla_id','rept_planilla')
            ->orderBy('rept_id')->whereBetween('rept_fecha', [$from->format('Y-m-d'), $to->format('Y-m-d')]);
        if (auth()->user()->hasRole('Super Administrador')) {
            $datas = $query->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $ter = auth()->user()->Terminales->pluck('ter_id');
            $datas = $query->whereIn('p.pla_empresa', $emp)->whereIn('p.pla_terminal', $ter)->get();
        }
        $date = $from->format('d/m/Y') . " / " . $to->format('d/m/Y');
        return view('planillas.generacion.eventual.reporte-turnos.index', ['datas' => $datas, 'date' => $date]);
    }

    public function create(Request $request)
    {
        return view('planillas.generacion.eventual.reporte-turnos.crear');
    }


    public function store(Request $request)
    {
        if ($request->session()->has('dataRept')) {
            DB::transaction(function () use($request) {
                $data = $request->session()->get('dataRept');
                $dataEmpleados = $request->session()->get('dataEmpleadosSeleccionados');
                $reporte = ReporteTurnos::create($data);
                foreach ($dataEmpleados as $item ){
                    $item['dett_reporte']= $reporte->rept_id;
                    DetalleTurnos::create($item);
                }
            });
            return redirect()->route('reporte-turnos')->with('mensaje', 'Reporte creado exitosamente.');

        } else {
            return redirect()->route('reporte-turnos')->withErrors( 'A ocurrido un error.');

        }
    }


    public function show($id)
    {
        $datas = DetalleTurnos::where('dett_reporte', $id)->orderBy('dett_id')->get();
        return view('planillas.generacion.eventual.reporte-turnos.show', compact('datas', 'id'));
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

    public function asignar(ValidacionReportesTurnos $request)
    {
        $data = $request->validated();
        $data['rept_inicio'] = Carbon::parse(Carbon::createFromFormat('d/m/Y H:i', $data['rept_fecha'] . ' ' . $data['rept_inicio']))->format('Y-m-d H:i:s');
        $data['rept_fin'] = Carbon::parse(Carbon::createFromFormat('d/m/Y H:i', $data['rept_fecha'] . ' ' . $data['rept_fin']))->format('Y-m-d H:i:s');
        $data['rept_fecha'] = Carbon::parse(Carbon::createFromFormat('d/m/Y', $data['rept_fecha']))->format('Y-m-d');
        $empleados = Empleado::where('empl_terminal', $data['rept_terminal'])->where('empl_empresa', $data['rept_empresa'])->where('empl_tipoSalario', '=', 'T')->get();
        $request->session()->put(['dataRept' => $data]);
        $request->session()->put(['dataEmpleados' => $empleados]);
        $request->session()->put(['dataEmpleadosSeleccionados' => []]);
        return view('planillas.generacion.eventual.reporte-turnos.asignar-empleados.crear');
    }

    public function asignarEmpleados(ValidacionDetalleTurnos $request)
    {
        if ($request->session()->has('dataRept')) {
            $empleados = $request->validated();
            $dataEmpleados = $request->session()->get('dataEmpleadosSeleccionados');
            $key = array_search(($empleados['dett_empleado']), array_column($dataEmpleados, 'dett_empleado'));
            if (false !== $key){
                return view('planillas.generacion.eventual.reporte-turnos.asignar-empleados.crear')->withErrors(['El empleado ya fue asignado']);
            } else {
                $request->session()->push('dataEmpleadosSeleccionados', $empleados);
                return view('planillas.generacion.eventual.reporte-turnos.asignar-empleados.crear')->with('mensaje', 'Empleado asigando con exito.');
            }
        } else {
            return redirect()->route('reporte-turnos.crear')->withErrors( 'A ocurrido un error.');

        }
    }

}
