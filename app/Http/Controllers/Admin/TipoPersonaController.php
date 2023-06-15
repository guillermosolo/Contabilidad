<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ValidacionTipoPersona;
use App\Models\Admin\TipoPersona;
use Exception;
use Illuminate\Http\Request;

class TipoPersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = TipoPersona::orderBy('tpp_id')->get();
        return view('admin.tipopersona.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tipopersona.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionTipoPersona $request)
    {
        if ($request->tpp_clasificacion == 'P') {
            $tipo = 'proveedor';
        } else {
            $tipo = 'cliente';
        }
        TipoPersona::create($request->all());
        return redirect('admin/tipopersona')->with('mensaje', 'Tipo de ' . $tipo . ' creado exitosamente.');
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
        $data = TipoPersona::findOrFail($id);
        return view('admin.tipopersona.editar', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionTipoPersona $request, $id)
    {
        if ($request->tpp_clasificacion == 'P') {
            $tipo = 'proveedor';
        } else {
            $tipo = 'cliente';
        }
        TipoPersona::findOrFail($id)->update($request->all());
        return redirect('admin/tipopersona')->with('mensaje', 'Tipo de ' . $tipo . ' actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $tipo)
    {
        if ($tipo == 'P') {
            $tipo = 'proveedor';
        } else {
            $tipo = 'cliente';
        }
        try {
            TipoPersona::destroy($id);
        } catch (Exception $e) {
            return redirect('admin/tipopersona')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('admin/tipopersona')->with('mensaje', 'Tipo de ' . $tipo . ' eliminando correctamente.');
    }

}
