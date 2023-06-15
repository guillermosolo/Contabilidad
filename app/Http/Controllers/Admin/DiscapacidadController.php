<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ValidacionDiscapacidad;
use App\Models\Admin\Discapacidad;
use Exception;
use Illuminate\Http\Request;

class DiscapacidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Discapacidad::orderBy('dis_id')->get();
        return view('admin.discapacidad.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.discapacidad.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionDiscapacidad $request)
    {
        Discapacidad::create($request->all());
        return redirect('admin/discapacidad')->with('mensaje', 'Discapacidad creada exitosamente.');
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
        $data = Discapacidad::findOrFail($id);
        return view('admin.discapacidad.editar', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionDiscapacidad $request, $id)
    {
        Discapacidad::findOrFail($id)->update($request->all());
        return redirect('admin/discapacidad')->with('mensaje', 'Discapacidad actualizada correctamente.');
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
            Discapacidad::destroy($id);
        } catch (Exception $e) {
            return redirect('admin/discapacidad')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('admin/discapacidad')->with('mensaje', 'Discapacidad eliminanda correctamente.');
    }
}
