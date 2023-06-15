<?php

namespace  App\Http\Controllers\Contabilidad;

use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Contabilidad\Poliza;
use App\Http\Controllers\Controller;
use App\Models\Contabilidad\DetPoliza;
use App\Http\Requests\Contabilidad\ValidacionPoliza;

class PolizaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('Super Administrador')) {
            $datas = Poliza::orderBy('pol_id')->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');

            $datas = Poliza::whereIn('pol_empresa', $emp)->orderBy('pol_id')->get();
        }
        return view('contabilidad/poliza/crear', compact('datas'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contabilidad.poliza.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(ValidacionPoliza $request)
    {
        dd($request->all());
        try {
            DB::transaction(function () use ($request) {
                $fecha = Carbon::createFromFormat('d/m/Y', $request->ordf_eta);
                $request['pol_fecha'] = Carbon::parse($fecha)->format('Y-m-d H:i:s');

                $orden = Poliza::create($request->all());

                foreach ($request->dpol_ctaContable as $i => $item) {
                    $detalle = new DetPoliza();
                    $detalle->dpol_idpoliza = $orden->pol_id;
                    $detalle->dpol_ctaContable = $item;
                    $detalle->dpol_monto = $request->dpol_monto[$i];
                    $detalle->dpol_posicion = $request->dpol_posicion[$i];
                    $detalle->save();
                }
            });
        } catch (Exception $e) {
            return redirect('contabilidad/poliza')->withErrors(['catch2', $e->errorInfo]);
        }
        return redirect('contabilidad/poliza')->with('mensajeHTML', "Poliza creada exitosamente");
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
