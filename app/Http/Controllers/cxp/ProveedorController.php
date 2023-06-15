<?php

namespace App\Http\Controllers\cxp;

use Exception;
use Illuminate\Http\Request;
Use App\Models\Admin\Persona;
use App\Models\cxp\Proveedor;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\cxp\ValidacionProveedores;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Proveedor::orderBy('pro_id')->get();
        return view('cxp.proveedores.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($nit)
    {
        $persona = Persona::where('per_nit', $nit)->first();
        if (!$persona||$nit=="CF") {
            $persona = compact('nit');
            return view('cxp.proveedores.crear', compact('persona'));
        } elseif ($persona->Proveedor()->count() > 0) {
            return redirect('cxp/proveedores')->withErrors('El proveedor con ese número de NIT, ya existe.');
        } else {
            return view('cxp.proveedores.crear', compact('persona'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionProveedores $request)
    {
        if (empty($request->pro_credito)) {
            $request->merge(['pro_credito' => '0']);
        }
        if ($request->nuevo == 1) {
            try {
                DB::transaction(function () use ($request) {
                    $persona = Persona::create($request->all());
                    $request->merge(['pro_persona' => $persona->per_id]);
                    Proveedor::create($request->all());
                });
            } catch (Exception $e) {
                return redirect('cxp/proveedores')->withErrors(['catch2', $e->errorInfo]);
            }
        } else {
            if ($request->editar) {
                try {
                    DB::transaction(function () use ($request) {
                        Persona::findOrFail($request->pro_persona)->update($request->all());
                        Proveedor::create($request->all());

                    });
                } catch (Exception $e) {
                    return redirect('cxp/proveedores')->withErrors(['catch2', $e->errorInfo]);
                }
            } else {
                Proveedor::create($request->all());
            }
        }
        return redirect('cxp/proveedores')->with('mensaje', 'Proveedor creado exitosamente.');
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
        $data = Proveedor::findOrFail($id);
        $persona = $data->Persona;
        return view('cxp.proveedores.editar', compact('data','persona'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionProveedores $request, $id)
    {
        if (empty($request->pro_credito)) {
            $request->merge(['pro_credito' => '0']);
        }
        if ($request->editar) {
            try {
                DB::transaction(function () use ($request,$id) {
                    Persona::findOrFail($request->pro_persona)->update($request->all());
                    Proveedor::findOrFail($id)->update($request->all());

                });
            } catch (Exception $e) {
                return redirect('cxp/proveedores')->withErrors(['catch2', $e->errorInfo]);
            }
        } else {
            Proveedor::findOrFail($id)->update($request->all());
        }
        return redirect('cxp/proveedores')->with('mensaje', 'Proveedor actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
