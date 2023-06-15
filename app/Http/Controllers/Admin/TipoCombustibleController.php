<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ValidacionTipoCombustible;
use App\Models\Admin\TipoCombustible;
use Exception;
use Illuminate\Http\Request;

class TipoCombustibleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = TipoCombustible::orderBy('tco_id')->get();
        return view('admin.tipocombustible.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tipocombustible.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionTipoCombustible $request)
    {
        TipoCombustible::create($request->all());
        return redirect('admin/tipocombustible')->with('mensaje', 'Tipo Combustible creado exitosamente.');
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
        $data = TipoCombustible::findOrFail($id);
        return view('admin.tipocombustible.editar',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionTipoCombustible $request, $id)
    {
        TipoCombustible::findOrFail($id)->update($request->all());
        return redirect('admin/tipocombustible')->with('mensaje', 'Tipo Combustible actualizado correctamente.');
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
            TipoCombustible::destroy($id);
        } catch (Exception $e) {
            return redirect('admin/tipocombustible')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('admin/tipocombustible')->with('mensaje', 'Tipo Combustible eliminando correctamente.');
    }
}
