<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ValidacionTipoContribuyente;
use App\Models\Admin\TipoContribuyente;
use Exception;

class TipoContribuyenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas =TipoContribuyente::orderBy('tpc_id')->get();
        return view('admin.tipocontribuyente.index',compact('datas'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tipocontribuyente.crear');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionTipoContribuyente $request)
    {
        TipoContribuyente::create($request->all());
        return redirect('admin/tipocontribuyente')->with('mensaje', 'Tipo de contribuyente creado exitosamente.');
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
        $data = TipoContribuyente::findOrFail($id);
        return view('admin.tipocontribuyente.editar',compact('data'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionTipoContribuyente $request, $id)
    {
        TipoContribuyente::findOrFail($id)->update($request->all());
        return redirect('admin/tipocontribuyente')->with('mensaje', 'Tipo de contribuyente actualizado correctamente.');
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
            TipoContribuyente::destroy($id);
        } catch (Exception $e) {
            return redirect('admin/tipocontribuyente')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('admin/tipocontribuyente')->with('mensaje', 'Tipo de contribuyente eliminando correctamente.');
    }
}
