<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ValidacionTipoRepresentante;
use App\Models\Admin\TiposRepresentante;
use Exception;
use Illuminate\Http\Request;

class TiposRepresentanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = TiposRepresentante::OrderBy('trep_id')->get();
        return view('admin.tiposrepresentante.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tiposrepresentante.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionTipoRepresentante $request)
    {
        TiposRepresentante::create($request->all());
        return redirect('admin/tiposrepresentante')->with('mensaje', 'Tipo de representante creado exitosamente.');
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
        $data = TiposRepresentante::findOrFail($id);
        return view('admin.tiposrepresentante.editar',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionTipoRepresentante $request, $id)
    {
        TiposRepresentante::findOrFail($id)->update($request->all());
        return redirect('admin/tiposrepresentante')->with('mensaje', 'Tipo de representante actualizado correctamente.');
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
            TiposRepresentante::destroy($id);
        } catch (Exception $e) {
            return redirect('admin/tiposrepresentante')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('admin/tiposrepresentante')->with('mensaje', 'Tipo de representante eliminando correctamente.');
    }
}
