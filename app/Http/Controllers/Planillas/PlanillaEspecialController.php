<?php

namespace App\Http\Controllers\Planillas;

use App\Exports\Planilla\PlanillaEspecialExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Planillas\ValidacionGeneracionPlanilla;
use App\Models\Planilla\DetallePlanilla;
use App\Models\Planilla\Empleado;
use App\Models\Planilla\Planilla;
use App\Models\Planilla\TiposDesc;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use phpDocumentor\Reflection\Types\True_;

class PlanillaEspecialController extends Controller
{

    public function index()
    {

        $datas = Planilla::where(function ($query) {
            $query = $query->orWhere('pla_tipo', '=', 'N');
            $query = $query->orWhere('pla_tipo', '=', 'A');
        });
        if (auth()->user()->hasRole('Super Administrador')) {
            $datas = $datas->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $ter = auth()->user()->Terminales->pluck('ter_id');
            $datas = $datas->whereIn('empl_empresa', $emp)->whereIn('empl_terminal', $ter)->get();
        }
        return view('planillas.generacion.especial.index', compact('datas'));
    }


    public function create()
    {
        $year= (new Planilla())->getFirstYear() ;
        $limitYear = now()->format('Y')-$year;
        return view('planillas.generacion.especial.crear', compact('year','limitYear'));

    }


    /**
     * @throws ValidationException
     */
    public function store(ValidacionGeneracionPlanilla $request)
    {
        $data = $request->validated();
        $empleados = $this->validarEmpleados($data['pla_empresa'], $data['pla_terminal'], $data['pla_fecha'], $data['pla_tipo']);
        $this->insertPlanillaEspecial($data, $empleados);
        return redirect('planillas/generacion/especial');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show($id)
    {

        $data = $this->getData($id);
        return view('planillas.generacion.especial.show', ['id' => $id, 'total' => $data['total'], 'dataPlanilla' => $data['dataPlanilla'], 'datas' => $data['datas']]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {

    }

    private function insertPlanillaEspecial($dataPlanilla, $dataEmpleado)
    {
        try {
            DB::transaction(function () use ($dataPlanilla, $dataEmpleado) {
                $pla = new Planilla();
                $dataPlanilla['pla_liquidacion'] = 0;
                $tipo = $dataPlanilla['pla_tipo'];
                $year = $dataPlanilla['pla_fecha'];
                $dataPlanilla['pla_inicio'] = $pla->getFechaInicial($year, $tipo);
                $dataPlanilla['pla_fin'] = $pla->getFechaFinal($year, $tipo);
                $tipoBono = TiposDesc::where('tipd_clase', '=', $tipo)->first();
                $planilla = Planilla::create($dataPlanilla);
                $bisiesto = checkdate(2, 29, $year);

                foreach ($dataEmpleado as $emp) {
                    $detalle = new DetallePlanilla();
                    $detalle->detp_planilla = $planilla->pla_id;
                    $detalle->dept_empleado = $emp->empl_id;
                    $detalle->dept_tipo = $tipoBono->tipd_id;
                    $detalle->dept_monto = $this->calcBono($emp, $planilla, $bisiesto);
                    $detalle->save();
                }

            });
        } catch (Exception $e) {
            return redirect('planillas/generacion/especial')->withErrors(['catch2', $e->errorInfo]);
        }
    }

    private function calcBono($emp, $planilla, $bisiesto)
    {
        $inicioEmpleado = Carbon::parse($emp->empl_inicio);
        $finPlanilla = Carbon::parse($planilla->pla_fin);
        $inicioPlanilla = Carbon::parse($planilla->pla_inicio);
        if ($inicioEmpleado>$inicioPlanilla){
            $daysYear = $bisiesto ? 366 : 365;
            $diferenciaDias = $inicioEmpleado->diffInDays($finPlanilla)+1;
            $monto = ($emp->empl_salario / $daysYear) * $diferenciaDias;

        }else{
            $monto = $emp->empl_salario;
        }
        return round($monto,2);
    }

    /**
     * @throws ValidationException
     */
    private function validarEmpleados($emp, $ter, $year, $tipo): \Illuminate\Support\Collection
    {
        $pla = new Planilla();
        $fechaFinal = $pla->getFechaFinal($year, $tipo);
        $planilla = Planilla::where('pla_fin', $fechaFinal)->where('pla_tipo',$tipo)->first();

        $emp = DB::table('empleados as e')
            ->select('e.empl_id', 'e.empl_salario', 'e.empl_inicio', 'e.empl_retiro')
            ->where('e.empl_terminal', $ter)
            ->where('e.empl_empresa', $emp)
            ->where(function ($query) use ($fechaFinal) {
                $query = $query->orWhere('e.empl_retiro', null);
                $query = $query->orWhereRaw("'" . $fechaFinal . "'" . '<=' . '[e].[empl_retiro]');
            })
            ->where('e.empl_inicio',"<=",$fechaFinal)
            ->where('e.empl_tipoSalario', '=', 'M')->get();
        if ($emp->first() == null) {
            throw ValidationException::withMessages(['No existe ningun empleado registrado en la terminal seleccionada']);
        }
        if ($planilla) {
            throw ValidationException::withMessages(['Ya existe una planilla con esta fecha']);
        }
        return $emp;
    }

    private function getData($id)
    {
        $pla = Planilla::find($id);
        $detalles = DB::table('detalleplanilla as d')
            ->join('tipodesc as t', 'd.dept_tipo', '=', 't.tipd_id')
            ->where('d.detp_planilla', $id)
            ->select('d.dept_empleado as empleado', 'd.dept_monto as monto', 't.tipd_clase');
        $data = $detalles->get();
        $tipo = $detalles->first()->tipd_clase;
        $year = intval(Carbon::parse($pla['pla_fecha'])->format('Y'));
        $planilla = $this->getDataPlanilla($pla, $year, $tipo);
        return ['datas' => $data, 'total' => $detalles->sum('d.dept_monto'), 'dataPlanilla' => $planilla];
    }

    private function getDataPlanilla($pla, $year, $tipo)
    {
        $pla['pla_inicio'] = Carbon::parse($pla['pla_inicio']);
        $pla['pla_fin'] = Carbon::parse($pla['pla_fin']);
        $pla['pla_tipo'] = $tipo;
        $pla['anio'] = $year;
        $pla['terminal'] = $pla->Terminal->ter_nombre;
        $pla['empresa'] = $pla->Empresa->emp_nombre;
        return $pla;
    }



    public function exportarExcel($id): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $data = $this->getData($id);
        $name = ($data['dataPlanilla']['pla_tipo'] == 'N' ? 'PLANILLA DE BONO 14' : 'PLANILLA DE AGUINALDO') . ' DEL ' . $data['dataPlanilla']['pla_inicio']->format('d-m-Y') . ' AL ' . $data['dataPlanilla']['pla_fin']->format('d-m-Y') . '.xlsx';
        return Excel::download(new PlanillaEspecialExport($this->getData($id)), $name);
    }

    public function exportarPDF($id)
    {
        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $data = $this->getData($id);
        $pdf->loadView('planillas.generacion.exports.especial.pdf', ['total' => $data['total'], 'dataPlanilla' => $data['dataPlanilla'], 'datas' => $data['datas']])->setPaper('letter', 'landscape');
        $name = ($data['dataPlanilla']['pla_tipo'] == 'N' ? 'PLANILLA DE BONO 14' : 'PLANILLA DE AGUINALDO') . ' DEL ' . $data['dataPlanilla']['pla_inicio']->format('d-m-Y') . ' AL ' . $data['dataPlanilla']['pla_fin']->format('d-m-Y') . '.pdf';
        return $pdf->download($name);
    }
}
