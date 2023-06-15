<?php

namespace App\Http\Controllers\Planillas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Planillas\ValidacionDescBon;
use App\Models\Contabilidad\CuentaContable;
use App\Models\Planilla\DescBon;
use App\Models\Planilla\Empleado;
use App\Models\Planilla\EnlaceDescBon;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class DescBonoController extends Controller
{

    public function index(Request $request)
    {
        if ($request->path() == 'planillas/descuentos') {$tipo = "D";} else {$tipo = "B";}
        if (auth()->user()->hasRole('Super Administrador')) {
            $datas =  DescBon::with('TiposDesc')->orderBy('desc_id')
                ->join('tipodesc','tipodesc.tipd_id','=','descbon.desc_tipo')
                ->where('tipodesc.tipd_clase', $tipo)->select('descbon.*')->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $datas =  DescBon::with('TiposDesc')->orderBy('desc_id')
                ->join('tipodesc','tipodesc.tipd_id','=','descbon.desc_tipo')
                ->join('cuentacontable','cuentacontable.cta_id','=','descbon.desc_cuentaContable')
                ->whereIn('cuentacontable.cta_empresa', $emp)
                ->where('tipodesc.tipd_clase', $tipo)->select('descbon.*')
                ->get();
        }
        return view('planillas.descbono.index', compact('datas', 'tipo'));

    }


    public function create(Request $request)
    {
        $tipo = $request->path() == 'planillas/descuentos/crear' ? 'D' : 'B';
        $this->resetSessionData($request);
        return view('planillas.descbono.crear', compact('tipo'));
    }


    public function store(ValidacionDescBon $request)
    {
        $tipo = $request->path() == 'planillas/descuentos' ? 'D' : 'B';
        if ($request->desc_general) {
            $data = $request->validated();
            $this->insertDescBon($data, [],$tipo);
            if ($tipo == 'D') {
                return redirect('planillas/descuentos')->with('mensaje', 'Descuento creado con exito.');
            } else {
                return redirect('planillas/bonificaciones')->with('mensaje', 'Bonificacion creada con exito.');
            }
        } else {
            $data = $request->validated();
            $data['desc_general']=0;
            $request->session()->put(['dataBon' => $data]);
            $empresa = CuentaContable::find($request->desc_cuentaContable)->cta_empresa;
            $empleados = Empleado::orderBy('empl_id')->where('empl_empresa', $empresa)->where('empl_tipoSalario', '=','M')->get();
            return view('planillas.descbono.especifico.crear', compact('tipo', 'empleados'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function setEmpleados(Request $request)
    {
        $tipo = $request->path() == 'planillas/descuentos/descuento-empleados' ? 'D' : 'B';
        if ($request->session()->has('dataBon')) {
            $empleados = explode(",", $request->empleados);
            $this->insertDescBon($request->session()->get('dataBon'), $empleados,$tipo);
            $this->resetSessionData($request);
            if ($tipo == 'D') {
                return redirect('planillas/descuentos')->with('mensaje', 'Descuento creado con exito.');
            } else {
                return redirect('planillas/bonificaciones')->with('mensaje', 'Bonificacion creada con exito.');
            }
        } else {
            if ($tipo == 'D') {
                return redirect('planillas/descuentos')->with('mensaje-error', 'A ocurrido un error.');
            } else {
                return redirect('planillas/bonificaciones')->with('mensaje-error', 'A ocurrido un error.');
            }
        }

    }

    private function insertDescBon($data, $empleados,$tipo)
    {
        try {
            DB::transaction(function () use ($data, $empleados) {
                $data['desc_inicio'] = Carbon::parse(Carbon::createFromFormat('d/m/Y', $data['desc_inicio']))->format('Y-m-d H:i:s');
                $data['desc_fin'] = $data['desc_fin'] ? Carbon::parse(Carbon::createFromFormat('d/m/Y', $data['desc_fin']))->format('Y-m-d H:i:s') : null;
                $descbon = DescBon::create($data);
                if( $data['desc_general']==0){
                    foreach ($empleados as $item) {
                        $enlace = new EnlaceDescBon();
                        $enlace->edb_empleado = $item;
                        $enlace->edb_descbon =  $descbon->desc_id;
                        $enlace->save();
                    }
                }
            });
        } catch (Exception $e) {
            if ($tipo == 'D') {
                return redirect('planillas/descuentos')->withErrors(['catch2', $e->errorInfo]);
            } else {
                return redirect('planillas/bonificaciones')->withErrors(['catch2', $e->errorInfo]);
            }
        }
    }

    private function resetSessionData($request)
    {
        if ($request->session()->has('dataBon')) {
            $request->session()->forget(['dataBon']);
        }
    }
}
