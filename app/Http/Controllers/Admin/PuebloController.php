<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ValidacionPueblo;
use App\Models\Admin\Pueblo;
use Exception;


class PuebloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Pueblo::orderBy('pue_id')->get();
        return view('admin.pueblo.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pueblo.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionPueblo $request)
    {
        Pueblo::create($request->all());
        return redirect('admin/pueblo')->with('mensaje', 'Pueblo creado exitosamente.');
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
        $data = Pueblo::findOrFail($id);
        return view('admin.pueblo.editar', compact('data'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionPueblo $request, $id)
    {
            Pueblo::findOrFail($id)->update($request->all());
        return redirect('admin/pueblo')->with('mensaje', 'Pueblo actualizado correctamente.');
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
            Pueblo::destroy($id);
        } catch (Exception $e) {
            return redirect('admin/pueblo')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('admin/pueblo')->with('mensaje', 'Pueblo eliminando correctamente.');
    }
}
