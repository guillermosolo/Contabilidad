<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ValidacionAcademico;
use App\Models\Admin\Academico;
use Exception;

class AcademicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Academico::orderBy('aca_id')->get();
        return view('admin.academico.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.academico.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionAcademico $request)
    {
        Academico::create($request->all());
        return redirect('admin/academico')->with('mensaje', 'Nivel académico creado exitosamente.');
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
        $data = Academico::findOrFail($id);
        return view('admin.academico.editar', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionAcademico $request, $id)
    {
            Academico::findOrFail($id)->update($request->all());
        return redirect('admin/academico')->with('mensaje', 'Nivel académico actualizado correctamente.');
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
            Academico::destroy($id);
        } catch (Exception $e) {
            return redirect('admin/academico')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('admin/academico')->with('mensaje', 'Nivel académico eliminando correctamente.');
    }
}
