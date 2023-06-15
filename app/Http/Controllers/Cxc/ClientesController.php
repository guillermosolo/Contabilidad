<?php

namespace App\Http\Controllers\Cxc;

use Exception;
use App\Models\Cxc\Clientes;
use Illuminate\Http\Request;
use App\Models\Admin\Persona;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cxc\ValidacionClientes;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Clientes::orderBy('cli_id')->get();
        return view('cxc.clientes.index', compact('datas'));
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
            return view('cxc.clientes.crear', compact('persona'));
        } elseif ($persona->Clientes()->count() > 0) {
            return redirect('cxc/clientes')->withErrors('El Cliente con ese número de NIT, ya existe.');
        } else {
            return view('cxc.clientes.crear', compact('persona'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionClientes $request)
    {
        if (empty($request->cli_credito)) {
            $request->merge(['cli_credito' => '0']);
        }
        if ($request->nuevo == 1) {
            try {
                DB::transaction(function () use ($request) {
                    $persona = Persona::create($request->all());
                    $request->merge(['cli_persona' => $persona->per_id]);
                    Clientes::create($request->all());
                });
            } catch (Exception $e) {
                return redirect('cxc/clientes')->withErrors(['catch2', $e->errorInfo]);
            }
        } else {
            if ($request->editar) {
                try {
                    DB::transaction(function () use ($request) {
                        Persona::findOrFail($request->cli_persona)->update($request->all());
                        Clientes::create($request->all());

                    });
                } catch (Exception $e) {
                    return redirect('cxc/clientes')->withErrors(['catch2', $e->errorInfo]);
                }
            } else {
                Clientes::create($request->all());
            }
        }
        return redirect('cxc/clientes')->with('mensaje', 'Cliente creado exitosamente.');
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
        $data = Clientes::findOrFail($id);
        $persona = $data->Persona;
        return view('cxc.clientes.editar', compact('data','persona'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionClientes $request, $id)
    {
        if (empty($request->_credito)) {
            $request->merge(['cli_credito' => '0']);
        }
        if ($request->editar) {
            try {
                DB::transaction(function () use ($request,$id) {
                    Persona::findOrFail($request->cli_persona)->update($request->all());
                    Clientes::findOrFail($id)->update($request->all());

                });
            } catch (Exception $e) {
                return redirect('cxc/clientes')->withErrors(['catch2', $e->errorInfo]);
            }
        } else {
            Clientes::findOrFail($id)->update($request->all());
        }
        return redirect('cxc/clientes')->with('mensaje', 'Cliente actualizado exitosamente.');
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


    public function ClientesDocumentos(Request $request, $cli){
        if ($request->ajax()) {
            $act = Clientes::where('cli_id', $cli)->get();
            return response()->json($act);
        } else {
            abort(404);
        }
    }

}
