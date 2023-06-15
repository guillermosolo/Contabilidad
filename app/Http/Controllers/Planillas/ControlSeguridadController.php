<?php

namespace App\Http\Controllers\Planillas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Planillas\ValidacionControlSeguridad;
use App\Models\Planilla\ControlSeguridad;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ControlSeguridadController extends Controller
{

    public function index(Request $request)
    {
        $this->resetSessionData($request);
        $to = Carbon::createFromFormat('d/m/Y',$request->get('to')?$request->get('to'):now()->format('d/m/Y'))->format('Y-m-d');
        if (auth()->user()->hasRole('Super Administrador')) {
            $datas = ControlSeguridad::orderBy('cons_id')->where('cons_fecha',$to)->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $ter = auth()->user()->Terminales->pluck('ter_id');
            $datas = DB::table('controlseguridad as c')
                ->join('empleados as e','e.empl_id','=','c.cons_empleado')
                ->select('c.cons_id','c.cons_fecha','c.cons_empleado','c.cons_ingreso','c.cons_salida')
                ->groupBy('c.cons_id','c.cons_fecha','c.cons_empleado','c.cons_ingreso','c.cons_salida')
                ->whereIn('e.empl_empresa', $emp)
                ->whereIn('e.empl_terminal', $ter)
                ->where('cons_fecha',$to)
                ->orderBy('c.cons_id')
                ->get();
        }
        return view('planillas.generacion.eventual.control-seguridad.index',compact('datas','to'));
    }

    public function create()
    {
        return  view('planillas.generacion.eventual.control-seguridad.crear');
    }


    public function store(ValidacionControlSeguridad $request)
    {


        $data= $request->validated();
        $request->session()->put(['dataControl' => $data]);
        $data['cons_ingreso'] = $data['cons_ingreso']? Carbon::parse(Carbon::createFromFormat('d/m/Y H:i',$data['cons_fecha'].' '.$data['cons_ingreso']))->format('Y-m-d H:i:s'): now()->startOfDay()->second(0)->format('Y-m-d H:i:s');
        $data['cons_salida'] = $data['cons_salida']?   Carbon::parse(Carbon::createFromFormat('d/m/Y H:i',  $data['cons_fecha'].' '.$data['cons_salida'] ))->format('Y-m-d H:i:s'): now()->endOfDay()->second(0)->format('Y-m-d H:i:s');
        $data['cons_fecha'] = Carbon::parse(Carbon::createFromFormat('d/m/Y',  $data['cons_fecha'] ))->format('Y-m-d');
        $this->vereficarExisteControl($data);

        ControlSeguridad::create($data);
        return redirect()->route('control-seguridad.crear')->with('mensaje', 'Control de seguridad igresado correctamente.');
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
    private  function  vereficarExisteControl($data){

        $control = ControlSeguridad::where('cons_empleado',$data['cons_empleado'])
            ->where('cons_fecha',$data['cons_fecha'])
            ->first();
        if ($control) {
            throw ValidationException::withMessages(['Ya existe un control ingresado para este empleado en la fecha seleccionada']);
        }
    }
    private function resetSessionData($request)
    {
        if ($request->session()->has('dataControl')) {
            $request->session()->forget(['dataControl']);
        }
    }

}
