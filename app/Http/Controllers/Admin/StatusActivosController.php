<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ValidacionStatusActivos;
use App\Models\Admin\StatusActivos;
use Exception;
class StatusActivosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = StatusActivos::OrderBy('sta_id')->get();
        return view('admin.statusactivos.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.statusactivos.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        StatusActivos::create($request->all());
        return redirect('admin/statusactivos')->with('mensaje', 'Status de Activo creado exitosamente.');
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
        $data = StatusActivos::findOrFail($id);
        return view('admin.statusactivos.editar',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionStatusActivos $request, $id)
    {
        if (!($request->sta_baja)) {
            $request->merge(['sta_baja' => '0']);
        }
        StatusActivos::findOrFail($id)->update($request->all());
        return redirect('admin/statusactivos')->with('mensaje', 'Status de Activo actualizada correctamente.');
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
            StatusActivos::destroy($id);
        } catch (Exception $e) {
            return redirect('admin/statusactivos')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('admin/statusactivos')->with('mensaje', 'Status de Activo eliminando correctamente.');
    }
}
