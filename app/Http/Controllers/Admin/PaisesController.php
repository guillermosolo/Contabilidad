<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ValidacionPaises;
use App\Models\Admin\Paises;
use Exception;
use Illuminate\Http\Request;

class PaisesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Paises::orderBy('pai_id')->get();
        return view('admin.paises.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.paises.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionPaises $request)
    {
        Paises::create($request->all());
        return redirect('admin/paises')->with('mensaje', 'País creado exitosamente.');
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Paises::findOrFail($id);
        return view('admin.paises.editar', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionPaises $request, $id)
    {
            Paises::findOrFail($id)->update($request->all());
        return redirect('admin/paises')->with('mensaje', 'País actualizado correctamente.');
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
            Paises::destroy($id);
        } catch (Exception $e) {
            return redirect('admin/paises')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('admin/paises')->with('mensaje', 'País eliminando correctamente.');
    }
}
