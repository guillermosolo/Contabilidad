<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ValidacionMovimientoBancario;
use App\Models\Admin\MovimientoBancario;
use Exception;
use Illuminate\Http\Request;

class MovimientoBancarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = MovimientoBancario::orderBy('movb_id')->get();
        return view('admin.movimientobancario.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.movimientobancario.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionMovimientoBancario $request)
    {
        MovimientoBancario::create($request->all());
        return redirect('admin/movimientobancario')->with('mensaje', 'Movimiento creado exitosamente.');
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
        $data = MovimientoBancario::findOrFail($id);
        return view('admin.movimientobancario.editar',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionMovimientoBancario $request, $id)
    {
        MovimientoBancario::findOrFail($id)->update($request->all());
        return redirect('admin/movimientobancario')->with('mensaje', 'Movimiento actualizada correctamente.');
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
            MovimientoBancario::destroy($id);
        } catch (Exception $e) {
            return redirect('admin/movimientobancario')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('admin/movimientobancario')->with('mensaje', 'Movimiento eliminanda correctamente.');
    }
}
