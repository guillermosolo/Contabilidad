<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ValidacionIdioma;
use App\Models\Admin\Idioma;
use Exception;
use Illuminate\Http\Request;

class IdiomaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Idioma::orderBy('idi_id')->get();
        return view('admin.idioma.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.idioma.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionIdioma $request)
    {
        Idioma::create($request->all());
        return redirect('admin/idioma')->with('mensaje', 'Idioma creado exitosamente.');
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
        $data = Idioma::findOrFail($id);
        return view('admin.idioma.editar', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionIdioma $request, $id)
    {
        Idioma::findOrFail($id)->update($request->all());
        return redirect('admin/idioma')->with('mensaje', 'Idioma actualizado correctamente.');
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
            Idioma::destroy($id);
        } catch (Exception $e) {
            return redirect('admin/idioma')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('admin/idioma')->with('mensaje', 'Idioma eliminando correctamente.');
    }


}
