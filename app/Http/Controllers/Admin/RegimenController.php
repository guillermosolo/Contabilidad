<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ValidacionRegimen;
use App\Models\Admin\Regimen;
use Exception;
use Illuminate\Http\Request;

class RegimenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Regimen::orderBy('reg_id')->get();
        return view('admin.regimen.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.regimen.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionRegimen $request)
    {
        Regimen::create($request->all());
        return redirect('admin/regimen')->with('mensaje', 'Régimen creado exitosamente.');
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
        $data = Regimen::findOrFail($id);
        return view('admin.regimen.editar',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionRegimen $request, $id)
    {
        Regimen::findOrFail($id)->update($request->all());
        return redirect('admin/regimen')->with('mensaje', 'Régimen actualizado correctamente.');
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
            Regimen::destroy($id);
        } catch (Exception $e) {
            return redirect('admin/regimen')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('admin/regimen')->with('mensaje', 'Régimen eliminando correctamente.');
    }
}
