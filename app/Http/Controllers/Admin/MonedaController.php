<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Moneda;
use App\Http\Requests\Admin\ValidacionMoneda;
use Exception;

class MonedaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Moneda::orderBy('mon_id')->get();
        return view('admin.moneda.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.moneda.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionMoneda $request)
    {
        Moneda::create($request->all());
        return redirect('admin/moneda')->with('mensaje', 'Moneda creada exitosamente.');
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
        $data = Moneda::findOrFail($id);
        return view('admin.moneda.editar',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionMoneda $request, $id)
    {
        Moneda::findOrFail($id)->update($request->all());
        return redirect('admin/moneda')->with('mensaje', 'Moneda actualizada correctamente.');
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
            Moneda::destroy($id);
        } catch (Exception $e) {
            return redirect('admin/moneda')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('admin/moneda')->with('mensaje', 'Moneda eliminanda correctamente.');
    }
}
