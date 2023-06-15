<?php

namespace App\Http\Controllers\Planillas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Planillas\ValidacionControlSeguridad;
use App\Http\Requests\Planillas\ValidacionReportesBarcos;
use App\Models\Planilla\ControlSeguridad;
use App\Models\Planilla\ReporteTurnosBarcos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ReporteBarcosController extends Controller
{

    public function index(Request $request)
    {
        [$from, $to] = explode(' / ', $request->get('date') ?: ' / ');
        $from = Carbon::createFromFormat('d/m/Y', $from ?: now()->format('d/m/Y'));
        $to = Carbon::createFromFormat('d/m/Y', $to ?: now()->format('d/m/Y'));
        $query = ReporteTurnosBarcos::with('Planilla')->join('planilla as p','p.pla_id','retb_planilla')
            ->orderBy('retb_id')
            ->where('retb_inicio', '>=', $from->format('Y-m-d'))
            ->where('retb_fin', '<=', $to->format('Y-m-d'));
        if (auth()->user()->hasRole('Super Administrador')) {
            $datas = $query->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $ter = auth()->user()->Terminales->pluck('ter_id');
            $datas = $query->whereIn('p.pla_empresa', $emp)->whereIn('p.pla_terminal', $ter)->get();
        }
        $date = $from->format('d/m/Y') . " / " . $to->format('d/m/Y');
        return view('planillas.generacion.eventual.reporte-barcos.index', ['datas' => $datas, 'date' => $date]);
    }

    public function create()
    {
        return view('planillas.generacion.eventual.reporte-barcos.crear');
    }


    public function store(ValidacionReportesBarcos $request)
    {
        $data = $request->validated();
        [$inicio, $fin] = explode(' / ', $data['retb_fecha']);
        $data['retb_inicio'] = Carbon::parse(Carbon::createFromFormat('d/m/Y', $inicio))->format('Y-m-d H:i:s');
        $data['retb_fin'] = Carbon::parse(Carbon::createFromFormat('d/m/Y', $fin))->format('Y-m-d H:i:s');
        ReporteTurnosBarcos::create($data);
        return back()->with('mensaje', 'Reporte ingresado con exito.')->withInput(['retb_empresa' => $data['retb_empresa'], 'retb_terminal' => $data['retb_terminal'], 'retb_planilla' => $data['retb_planilla'], 'retb_fecha' => $data['retb_fecha']]);
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


}
