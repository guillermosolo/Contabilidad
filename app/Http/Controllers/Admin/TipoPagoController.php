<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ValidacionTipoPago;
use App\Models\Admin\TipoPago;
use Illuminate\Http\Request;
use Exception;


class TipoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $datas = TipoPago::OrderBy('tip_id')->get();
        return view('admin.tipopago.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tipopago.crear');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionTipoPago $request)
    { //dd($request->all());
        if(!($request->tip_referencia)){
            $request->merge(['tip_referencia'=>'0']);
            $request["tip_tabla"]='';
        }
        TipoPago::create($request->all());
        return redirect('admin/tipopago')->with('mensaje', 'Tipo de pago creado exitosamente.');
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
        $data = TipoPago::findOrFail($id);
        return view('admin.tipopago.editar', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionTipoPago $request, $id)
    {
        if(!($request->tip_referencia)){
            $request->merge(['tip_referencia'=>'0']);
            $request["tip_tabla"]='';
        }
        TipoPago::findOrFail($id)->update($request->all());
        return redirect('admin/tipopago')->with('mensaje', 'Tipo de pago actualizado correctamente.');
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
            TipoPago::destroy($id);
        } catch (Exception $e) {
            return redirect('admin/tipopago')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('admin/tipopago')->with('mensaje', 'Tipo de pago eliminando correctamente.');
    }
}
