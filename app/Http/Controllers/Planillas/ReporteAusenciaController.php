<?php

namespace App\Http\Controllers\Planillas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Planillas\ValidacionReporteAusencia;
use App\Models\Planilla\ReporteAusencia;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReporteAusenciaController extends Controller
{
    public function index()
    {
        $query  =   ReporteAusencia::with('Empleado')->join('empleados as e','e.empl_id','=','reporteausencia.rea_empleado') ->orderBy('rea_id');
        if (auth()->user()->hasRole('Super Administrador')) {
            $datas =  $query->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $ter = auth()->user()->Terminales->pluck('ter_id');
            $datas = $query->whereIn('empl_empresa', $emp)->whereIn('empl_terminal', $ter)->orderBy('empl_id')->where('empl_id', '>', 0)->get();
        }
        return  view('planillas.generacion.mensual.reporteausencia.index',compact('datas'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('planillas.generacion.mensual.reporteausencia.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ValidacionReporteAusencia $request)
    {
        $data = $request->validated();
        [$inicio ,$fin]= explode(' / ',$data['fecha']);
        $inicio = Carbon::createFromFormat('d/m/Y', $inicio)->format('Y-m-d H:i:s');
        $fin = Carbon::createFromFormat('d/m/Y', $fin)->format('Y-m-d H:i:s');
        ReporteAusencia::create([
            'rea_empleado'=>$data['empleado'],
            'rea_inicio'=>$inicio,
            'rea_fin'=>$fin,
            'rea_observaciones' => $data['observaciones']
        ]);
        return redirect()->route('reporte-ausencia')->with('mensaje', 'Reporte ingresado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
