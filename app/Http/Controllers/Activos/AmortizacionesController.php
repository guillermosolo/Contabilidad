<?php

namespace App\Http\Controllers\Activos;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Activos\Tabla;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Activos\CuentasAmortizacion;

class AmortizacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('Super Administrador')) {
            $datas = CuentasAmortizacion::orderBy('cam_id')->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $ter = auth()->user()->Terminales->pluck('ter_id');
            $datas = CuentasAmortizacion::whereIn('cam_empresa', $emp)->whereIn('cam_terminal', $ter)->orderBy('cam_id')->get();
        }
        return view('activos.amortizaciones.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('activos.amortizaciones.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request["cam_porcentaje"] = $request["cam_porcentaje"] / 100;
            try {
                DB::transaction(function () use ($request) {
                    $ctaAmort = CuentasAmortizacion::create($request->all());
                    $saldo = $request->cam_monto - $request->cam_inicial;
                    $alta = Carbon::parse($request->cam_fecha);
                    $hoy = Carbon::now();
                    $hoy = Carbon::parse($hoy->format('Y-m-t'));
                    $mensual = ($request->cam_monto * $request->cam_porcentaje) / 12;
                    if (($alta->year < $hoy->year) || (($alta->month < $hoy->month) && ($alta->year == $hoy->year))) {
                        $tabla = new Tabla;
                        $tabla->tab_activo = $ctaAmort->cam_id;
                        if ($hoy->month == 1) {
                            $tabla->tab_mes = 12;
                            $tabla->tab_anio = $hoy->year - 1;
                        } else {
                            $tabla->tab_mes = $hoy->month - 1;
                            $tabla->tab_anio = $hoy->year;
                        }
                        $tabla->tab_monto = $request->cam_inicial;
                        $tabla->tab_tipo = "A";
                        $tabla->tab_operado = 1;
                        $tabla->save();
                        $mesT = $hoy->month;
                        $anioT = $hoy->year;
                    } else {
                        $diferencia = date_diff($hoy, $alta);
                        $dias =  (int) $diferencia->format('%a');
                        $pmes = ($mensual / 30) * $dias;
                        $saldo = $request->cam_monto - $pmes;
                        $mesT = $hoy->month;
                        $anioT = $hoy->year;
                        $tabla = new Tabla;
                        $tabla->tab_activo = $ctaAmort->cam_id;
                        $tabla->tab_mes = $mesT;
                        $tabla->tab_anio = $anioT;
                        $tabla->tab_monto = $pmes;
                        $tabla->tab_tipo = "A";
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
                        $tabla->tab_activo = $ctaAmort->cam_id;
                        $tabla->tab_mes = $mesT;
                        $tabla->tab_anio = $anioT;
                        $tabla->tab_monto = $mensual;
                        $tabla->tab_tipo = "A";
                        $tabla->tab_operado = 0;
                        $tabla->save();
                        $saldo -= $mensual;
                        $mesT++;
                    }
                    if ($saldo > 0) {
                        $tabla = new Tabla;
                        if ($mesT > 12) {
                            $mesT = 1;
                            $anioT = $anioT + 1;
                        }
                        $tabla->tab_activo = $ctaAmort->cam_id;
                        $tabla->tab_mes = $mesT;
                        $tabla->tab_anio = $anioT;
                        $tabla->tab_monto = $saldo - 0.01;
                        $tabla->tab_tipo = "A";
                        $tabla->tab_operado = 0;
                        $tabla->save();
                    }
                });
            } catch (Exception $e) {
                return redirect('activos/amortizacion')->withErrors(['catch2', $e->errorInfo]);
            }
        return redirect('activos/amortizacion')->with('mensaje', 'Activo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activo = CuentasAmortizacion::findOrFail($id);
        $tabla = Tabla::where('tab_activo',$id)->where('tab_tipo','A')->orderBy('tab_anio')->orderBy('tab_mes')->get();
        return view('activos.amortizaciones.mostrar', compact('activo','tabla'));
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
