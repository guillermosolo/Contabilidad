<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ValidacionCertificador;
use App\Models\Admin\Certificador;
use Exception;

class CertificadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Certificador::orderBy('cer_id')->get();
        return view('admin.certificador.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.certificador.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionCertificador $request)
    {
        Certificador::create($request->all());
        return redirect('admin/certificador')->with('mensaje', 'Certificador creado exitosamente.');
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
        $data = Certificador::findOrFail($id);
        return view('admin.certificador.editar',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionCertificador $request, $id)
    {
        Certificador::findOrFail($id)->update($request->all());
        return redirect('admin/certificador')->with('mensaje', 'Certificador actualizado correctamente.');
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
            Certificador::destroy($id);
        } catch (Exception $e) {
            return redirect('admin/certificador')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('admin/certificador')->with('mensaje', 'Certificador eliminando correctamente.');
    }
}
