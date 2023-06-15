<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ValidacionFirmante;
use App\Models\Admin\Firmante;
use Exception;


class FirmanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas =Firmante::orderBy('fir_id')->get();
        return view('admin.firmante.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.firmante.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionFirmante $request)
    {
        Firmante::create($request->all());
        return redirect('admin/firmante')->with('mensaje', 'Firmante creado exitosamente.');
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
        $data = Firmante::findOrFail($id);
        return view('admin.firmante.editar',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionFirmante $request, $id)
    {
        Firmante::findOrFail($id)->update($request->all());
        return redirect('admin/firmante')->with('mensaje', 'Firmante actualizado correctamente.');
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
            Firmante::destroy($id);
        } catch (Exception $e) {
            return redirect('admin/firmante')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('admin/firmante')->with('mensaje', 'Firmante eliminando correctamente.');
    }
}
