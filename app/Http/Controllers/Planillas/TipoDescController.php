<?php

namespace App\Http\Controllers\Planillas;
use Exception;

use App\Http\Controllers\Controller;
use App\Http\Requests\Planillas\ValidacionTipoDesc;
use App\Models\Planilla\TiposDesc;
use Illuminate\Http\Request;

class TipoDescController extends Controller
{

    public function index()
    {
        $datas = TiposDesc::orderBy('tipd_id')->orWhere('tipd_clase','=','D')->orWhere('tipd_clase','=','B')->get();
        return view('planillas.tipodesc.index',compact('datas'));
    }


    public function create()
    {
        return view('planillas.tipodesc.crear');
    }


    public function store(ValidacionTipoDesc $request)
    {
        $data = $request->validated();
        TiposDesc::create($data);
        return redirect('planillas/tipo-descuentos')->with('mensaje', 'Tipo creado con exito.');

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


    public function edit($id)
    {
        $tipd = TiposDesc::find($id);
        return view('planillas.tipodesc.editar',compact('tipd'));
    }

    public function update(ValidacionTipoDesc $request, $id)
    {
        $data = $request->validated();
        $tipd = TiposDesc::find($id);
        $tipd->fill($data);
        $tipd->save();
        return redirect('planillas/tipo-descuentos')->with('mensaje', 'Tipo actualizado con exito.');
    }


    public function destroy($id)
    {
            try {
                TiposDesc::destroy($id);
            } catch (Exception $e) {
                return redirect('planillas/tipo-descuentos')->withErrors(['catch', $e->errorInfo]);
            }
        return redirect('planillas/tipo-descuentos')->with('mensaje', 'Tipo eliminando correctamente.');

    }
}
