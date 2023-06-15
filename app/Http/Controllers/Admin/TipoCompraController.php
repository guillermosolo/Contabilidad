<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ValidacionTipoCompra;
use App\Models\Admin\TipoCompra;
use Exception;
use Illuminate\Http\Request;

class TipoCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = TipoCompra::orderBy('tipc_id')->get();
        return view('admin.tipocompra.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tipocompra.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionTipoCompra $request)
    {
        TipoCompra::create($request->all());
        return redirect('admin/tipocompra')->with('mensaje', 'Tipo de compra creado exitosamente.');
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
        $data = TipoCompra::findOrFail($id);
        return view('admin.tipocompra.editar',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionTipoCompra $request, $id)
    {
        TipoCompra::findOrFail($id)->update($request->all());
        return redirect('admin/tipocompra')->with('mensaje', 'Tipo de compra actualizado correctamente.');
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
            TipoCompra::destroy($id);
        } catch (Exception $e) {
            return redirect('admin/tipocompra')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('admin/tipocompra')->with('mensaje', 'Tipo de compra eliminando correctamente.');
    }
}
