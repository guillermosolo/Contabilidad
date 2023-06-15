<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ValidacionRepresentante;
use App\Models\Admin\Representante;
use Illuminate\Http\Request;
use Exception;

class RepresentanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Representante::orderBy('repr_id')->get();
        return view('admin.representante.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.representante.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionRepresentante $request)
    {
        Representante::create($request->all());
        return redirect('admin/representante')->with('mensaje', 'Representante creado exitosamente.');
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
        $data = Representante::findOrFail($id);
        return view('admin.representante.editar',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionRepresentante $request, $id)
    {
        Representante::findOrFail($id)->update($request->all());
        return redirect('admin/representante')->with('mensaje', 'Representante actualizado correctamente.');
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
            Representante::destroy($id);
        } catch (Exception $e) {
            return redirect('admin/representante')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('admin/representante')->with('mensaje', 'Representante eliminando correctamente.');
    }
}
