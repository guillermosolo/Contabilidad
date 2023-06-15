<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ValidacionPropiedad;
use App\Models\Admin\Propiedad;
use Exception;

class PropiedadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas =Propiedad::orderBy('prop_id')->get();
        return view('admin.propiedad.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.propiedad.crear');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionPropiedad $request)
    {
        Propiedad::create($request->all());
        return redirect('admin/propiedad')->with('mensaje', 'Propiedad creada exitosamente.');
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
        $data = Propiedad::findOrFail($id);
        return view('admin.propiedad.editar',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(ValidacionPropiedad $request, $id)
    {
        Propiedad::findOrFail($id)->update($request->all());
        return redirect('admin/propiedad')->with('mensaje', 'Propiedad actualizada correctamente.');
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
            Propiedad::destroy($id);
        } catch (Exception $e) {
            return redirect('admin/propiedad')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('admin/propiedad')->with('mensaje', 'Propiedad eliminanda correctamente.');
    }
}
