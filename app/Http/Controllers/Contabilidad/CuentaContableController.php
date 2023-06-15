<?php

namespace App\Http\Controllers\Contabilidad;

use App\Http\Controllers\Controller;
use App\Models\Contabilidad\CuentaContable;
use App\Models\cyb\CajaChica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CuentaContableController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function CuentaActivoGasto(request $request, $emp, $ter, $nivel1, $detalle = 0)
    {
        $nivel2 = "[1-9]";
        $ter = str_pad($ter, 2, '0', STR_PAD_LEFT);
        if ($request->ajax()) {
            if ($nivel1 == "[1]") {
                $nivel2 = "[^123457]";
                if ($detalle == 1) {
                    $cta = CuentaContable::where('cta_empresa', $emp)->where('cta_codigo', 'LIKE', $nivel1 . $nivel2 . "%")->where('cta_detalle', 1)->where('cta_tipoSaldo', 'D')->get();
                } else {
                    $cta = CuentaContable::where('cta_empresa', $emp)->where('cta_codigo', 'LIKE', $nivel1 . $nivel2 . "%")->where('cta_tipoSaldo', 'D')->get();
                }
            } else {
                if ($detalle == 1) {
                    $cta = CuentaContable::where('cta_empresa', $emp)->where('cta_codigo', 'LIKE', $nivel1 . $nivel2 . $ter . "%")->where('cta_detalle', 1)->get();
                } else {
                    $cta = CuentaContable::where('cta_empresa', $emp)->where('cta_codigo', 'LIKE', $nivel1 . $nivel2 . $ter . "%")->get();
                }
            }
            return response()->json($cta);
        } else {
            abort(404);
        }
    }

    public function CuentasExcentas(request $request, $emp, $ter)
    {
        $ter = str_pad($ter, 2, '0', STR_PAD_LEFT);
        if ($request->ajax()) {
            $cta = CuentaContable::where('cta_empresa', $emp)->where('cta_excento', 1)->where('cta_codigo', 'LIKE', '[57]_' . $ter . '%')->get();
            return response()->json($cta);
        } else {
            abort(404);
        }
    }

    public function CuentaDepreciacion(request $request, $emp, $ter, $nivel1, $detalle = 0)
    {
        $nivel2 = "1";
        $nivel4 = "07";
        if ($ter == 99) {
            $nivel1 = "7";
            $nivel4 = "03";
        }
        $ter = str_pad($ter, 2, '0', STR_PAD_LEFT);
        if ($request->ajax()) {
            if ($detalle == 1) {
                $cta = CuentaContable::where('cta_empresa', $emp)->where('cta_codigo', 'LIKE', $nivel1 . $nivel2 . $ter . $nivel4 . "%")->where('cta_detalle', 1)->get();
            } else {
                $cta = CuentaContable::where('cta_empresa', $emp)->where('cta_codigo', 'LIKE', $nivel1 . $nivel2 . $ter . $nivel4 . "%")->get();
            }
            return response()->json($cta);
        } else {
            abort(404);
        }
    }

    public function CuentaAmortizacion(request $request, $emp, $ter, $detalle = 0)
    {
        $nivel1 = "7";
        $nivel2 = "1";
        $ter = str_pad($ter, 2, '0', STR_PAD_LEFT);
        if ($request->ajax()) {
            if ($detalle == 1) {
                $cta = CuentaContable::where('cta_empresa', $emp)->where('cta_codigo', 'LIKE', $nivel1 . $nivel2 . "%")->where('cta_detalle', 1)->where('cta_descripcion', 'LIKE', 'AMORTIZACION%')->get();
            } else {
                $cta = CuentaContable::where('cta_empresa', $emp)->where('cta_codigo', 'LIKE', $nivel1 . $nivel2 . "%")->where('cta_descripcion', 'LIKE', 'AMORTIZACION%')->get();
            }
            return response()->json($cta);
        } else {
            abort(404);
        }
    }

    public function CuentaDepAcum(request $request, $emp, $detalle = 0)
    {
        if ($request->ajax()) {
            if ($detalle == 1) {
                $cta = CuentaContable::where('cta_empresa', $emp)->where('cta_codigo', 'LIKE', "17%")->where('cta_detalle', 1)->get();
            } else {
                $cta = CuentaContable::where('cta_empresa', $emp)->where('cta_codigo', 'LIKE', "17%")->get();
            }
            return response()->json($cta);
        } else {
            abort(404);
        }
    }

    public function CuentaAmortAcum(request $request, $emp, $detalle = 0)
    {
        if ($request->ajax()) {
            if ($detalle == 1) {
                $cta = CuentaContable::where('cta_empresa', $emp)->where('cta_codigo', 'LIKE', "180102%")->where('cta_detalle', 1)->where('cta_tipoSaldo', 'H')->get();
            } else {
                $cta = CuentaContable::where('cta_empresa', $emp)->where('cta_codigo', 'LIKE', "180102%")->get();
            }
            return response()->json($cta);
        } else {
            abort(404);
        }
    }

    public function CuentaPorNivel(Request $request, $emp, $nivel = 'planillas', $detalle = 0)
    {

        if ($request->ajax()) {
            if ($nivel == 'planillas') {
                $nivel1 = '[75]';
                if ($detalle == 1) {
                    $cta = CuentaContable::where('cta_empresa', $emp)->where('cta_codigo', 'LIKE', $nivel1 . "%")->where('cta_detalle', 1)->get();
                } else {
                    $cta = CuentaContable::where('cta_empresa', $emp)->where('cta_codigo', 'LIKE', $nivel1 . "%")->get();
                }
            } elseif ($nivel == 'caja') {
                [$empresa,$terminal]= explode('-',$emp);
                $nivel1 = '[57][0-9]'.str_pad($terminal, 2, "0", STR_PAD_LEFT).'%';
                if ($detalle == 1) {
                    $cta = CuentaContable::where('cta_empresa', $empresa)->where('cta_codigo', 'LIKE', $nivel1 . "%")->where('cta_detalle', 1)->get();
                } else {
                    $cta = CuentaContable::where('cta_empresa', $emp)->where('cta_codigo', 'LIKE', $nivel1)->get();
                }
            } else {
                [$empresa,$tipo]= explode('-',$emp);
                $nivel1 = '1101'.$tipo;
                if ($detalle == 1) {
                    $cta = CuentaContable::where('cta_empresa', $empresa)->where('cta_codigo', 'LIKE', $nivel1 . "%")->where('cta_detalle', 1)->get();
                } else {
                    $cta = CuentaContable::where('cta_empresa', $emp)->where('cta_codigo', 'LIKE', $nivel1)->get();
                }
            }
            return response()->json($cta);
        } else {
            abort(404);
        }
    }

    public function CuentaCajaChica(Request $request, $emp)
    {
        $nivel1 = '11';
        if ($request->ajax()) {
            $cajas = CajaChica::where('cch_id', '>', 0)->get()->pluck('cch_cuentacontable');
                $cta = CuentaContable::where('cta_empresa', $emp)
                    ->where('cta_codigo', 'LIKE', $nivel1."%")
                    ->where('cta_descripcion', 'LIKE', 'CAJA'."%")
                    ->whereNotIn('cta_id',$cajas)
                    ->get();
            return response()->json($cta);
        } else {
            abort(404);
        }
    }

    public function Poliza(Request $request, $emp)
    {
        if ($request->ajax()) {
            $act = CuentaContable::where('cta_empresa', $emp)->where('cta_detalle', 'LIKE', '1%')->get();
            return response()->json($act);
        } else {
            abort(404);
        }
    }


}
