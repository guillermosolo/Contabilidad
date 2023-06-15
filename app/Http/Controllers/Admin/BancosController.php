<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ValidacionBancos;
use Illuminate\Http\Request;
use App\Models\Admin\Bancos;
use Exception;


class BancosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Bancos::where('ban_id','>',0)->orderBy('ban_id')->get();
        return view('admin.bancos.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bancos.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionBancos $request)
    {
        Bancos::create($request->all());
        return redirect('admin/bancos')->with('mensaje', 'Banco creado exitosamente.');
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
        $data = Bancos::findOrFail($id);
        return view('admin.bancos.editar',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionBancos $request, $id)
    {

        Bancos::findOrFail($id)->update($request->all());
        return redirect('admin/bancos')->with('mensaje', 'Banco actualizado correctamente.');
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
            Bancos::destroy($id);
        } catch (Exception $e) {
            return redirect('admin/bancos')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('admin/bancos')->with('mensaje', 'Banco eliminando correctamente.');
    }
}
