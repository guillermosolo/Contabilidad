<?php

namespace App\Http\Controllers\Activos;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Activos\Activos;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Activos\ValidacionActivos;
use App\Models\Activos\Tabla;

class ActivosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('Super Administrador')) {
            $datas = Activos::where('act_id', '>', 0)->orderBy('act_id')->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $ter = auth()->user()->Terminales->pluck('ter_id');
            $datas = Activos::whereIn('act_empresa', $emp)->whereIn('act_terminal', $ter)->orderBy('act_id')->get();
        }
        return view('activos.activo.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('activos.activo.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionActivos $request)
    {
        if (!($request->act_propio)) {
            $request->merge(['act_propio' => '0']);
        }
        if(!($request->act_depreciar)){
            $request->merge(['act_depreciar'=>'0']);
        }
        $request["act_porcentaje"] = $request["act_porcentaje"] / 100;
        if (($request->act_propio == 1) || ($request->act_depreciar == 0)) {
            $request["act_cuentaDep"] = 1;
            $request["act_cuentaDepAcum"] = 1;
            $request["act_porcentaje"] = 0;
            Activos::create($request->all());
        } else {
            try {
                DB::transaction(function () use ($request) {
                    $activo = Activos::create($request->all());
                    $saldo = $request->act_valor - $request->act_inicial;
                    $alta = Carbon::parse($request->act_fechaAlta);
                    $hoy = Carbon::now();
                    $hoy = Carbon::parse($hoy->format('Y-m-t'));
                    $mensual = ($request->act_valor * $request->act_porcentaje) / 12;
                    if (($alta->year < $hoy->year) || (($alta->month < $hoy->month) && ($alta->year == $hoy->year))) {
                        $tabla = new Tabla;
                        $tabla->tab_activo = $activo->act_id;
                        if ($hoy->month == 1) {
                            $tabla->tab_mes = 12;
                            $tabla->tab_anio = $hoy->year - 1;
                        } else {
                            $tabla->tab_mes = $hoy->month - 1;
                            $tabla->tab_anio = $hoy->year;
                        }
                        $tabla->tab_monto = $request->act_inicial;
                        $tabla->tab_tipo = "D";
                        $tabla->tab_operado = 1;
                        $tabla->save();
                        $mesT = $hoy->month;
                        $anioT = $hoy->year;
                    } else {
                        $diferencia = date_diff($hoy, $alta);
                        $dias =  (int) $diferencia->format('%a');
                        $pmes = ($mensual / 30) * $dias;
                        $saldo = $request->act_valor - $pmes;
                        $mesT = $hoy->month;
                        $anioT = $hoy->year;
                        $tabla = new Tabla;
                        $tabla->tab_activo = $activo->act_id;
                        $tabla->tab_mes = $mesT;
                        $tabla->tab_anio = $anioT;
                        $tabla->tab_monto = $pmes;
                        $tabla->tab_tipo = "D";
                        $tabla->tab_operado = 0;
                        $tabla->save();
                        $mesT++;
                    }
                    while ($saldo > $mensual) {
                        $tabla = new Tabla;
                        if ($mesT > 12) {
                            $mesT = 1;
                            $anioT = $anioT + 1;
                        }
                        $tabla->tab_activo = $activo->act_id;
                        $tabla->tab_mes = $mesT;
                        $tabla->tab_anio = $anioT;
                        $tabla->tab_monto = $mensual;
                        $tabla->tab_tipo = "D";
                        $tabla->tab_operado = 0;
                        $tabla->save();
                        $saldo -= $mensual;
                        $mesT++;
                    }
                    if ($saldo > 1) {
                        $tabla = new Tabla;
                        if ($mesT > 12) {
                            $mesT = 1;
                            $anioT = $anioT + 1;
                        }
                        $tabla->tab_activo = $activo->act_id;
                        $tabla->tab_mes = $mesT;
                        $tabla->tab_anio = $anioT;
                        $tabla->tab_monto = $saldo;
                        $tabla->tab_tipo = "D";
                        $tabla->tab_operado = 0;
                        $tabla->save();
                    }
                });
            } catch (Exception $e) {
                return redirect('activos/activo')->withErrors(['catch2', $e->errorInfo]);
            }
        }
        return redirect('activos/activo')->with('mensaje', 'Activo creado exitosamente.');
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
        $data = Activos::findOrFail($id);
        if ($data->act_porcentaje > 0) {
            $act_depreciar = 1;
        } else {
            $act_depreciar = 0;
        }
        return view('activos.activo.editar', compact('data', 'act_depreciar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionActivos $request, $id)
    {
        if (!($request->act_propio)) {
            $request->merge(['act_propio' => '0']);
        }
        Activos::findOrFail($id)->update($request->all());
        return redirect('activos/activo')->with('mensaje', 'Activo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
            Activos::destroy($id);

            });
        } catch (Exception $e) {
            return redirect('activos/activo')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('activos/activo')->with('mensaje', 'Usuario eliminando correctamente.');
    }

    public function propiedades($id)
    {
        $data = Activos::findOrFail($id);
        return view('activos.activo.propiedades', compact('data'));
    }

    public function actualizarProp(Request $request, $id)
    {
        $activo = new Activos();
        $activo->find($request->input('adi_activo'))->Propiedades()->syncWithoutDetaching([$request->input('adi_propiedad') => ['adi_valor' => $request->input('adi_valor')]]);
        activity('Propiedad')->performedOn($activo)
            ->withProperties(['activo' => $request->adi_activo, 'attributes' => ['adi_propiedad' => $request->adi_propiedad, 'adi_valor' => $request->adi_valor]])->log('asignacion');
        return redirect('activos/activo/' . $id . '/propiedades')->with('mensaje', 'Propiedad asignada correctamente.');
    }

    public function eliminarProp($id, $prop, $val)
    {
        $activo = new Activos();
        $activo->find($id)->Propiedades()->detach($prop);
        activity('Propiedad')->performedOn($activo)
            ->withProperties(['activo' => $id, 'attributes' => ['adi_propiedad' => $prop, 'adi_valor' => $val]])->log('desasignacion');
        return redirect('activos/activo/' . $id . '/propiedades')->with('mensaje', 'Propiedad desasignada correctamente.');
    }

    public function listaActivos(Request $request, $emp){
        if ($request->ajax()) {
            $act = Activos::where('act_empresa', $emp)->where('act_fechaBaja',null)->get();
            return response()->json($act);
        } else {
            abort(404);
        }
    }
}
