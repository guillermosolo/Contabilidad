<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ValidacionCategoria;
use App\Models\Admin\Categoria;
use Exception;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Categoria::orderBy('cat_id')->get();
        return view('admin.categoria.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categoria.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionCategoria $request)
    {
        if ($request->cat_tipo == 'D') {
            $tipo = 'Depreciación';
        } else {
            $tipo = 'Amortización';
        }
        $request["cat_porcentaje"]=$request["cat_porcentaje"]/100;
        Categoria::create($request->all());
        return redirect('admin/categoria')->with('mensaje', $tipo . ' creada exitosamente.');
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
        $data = Categoria::findOrFail($id);
        return view('admin.categoria.editar',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionCategoria $request, $id)
    {
        if ($request->cat_tipo == 'D') {
            $tipo = 'Depreciación';
        } else {
            $tipo = 'Amortización';
        }
        $request["cat_porcentaje"]=$request["cat_porcentaje"]/100;
        Categoria::findOrFail($id)->update($request->all());
        return redirect('admin/categoria')->with('mensaje', $tipo . ' actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$tipo)
    {
        if ($tipo == 'D') {
            $tipo = 'Depreciación';
        } else {
            $tipo = 'Amortización';
        }
        try {
            Categoria::destroy($id);
        } catch (Exception $e) {
            return redirect('admin/categoria')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('admin/categoria')->with('mensaje',$tipo . ' eliminanda correctamente.');
    }
}
