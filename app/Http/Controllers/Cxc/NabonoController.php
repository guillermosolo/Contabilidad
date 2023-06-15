<?php

namespace App\Http\Controllers\Cxc;

use Exception;
use Carbon\Carbon;
use App\Models\Admin\Moneda;
use Illuminate\Http\Request;
use App\Models\Admin\Persona;
use App\Models\Cxc\Facturacion;
use App\Models\Cxc\DetalleVentas;
use App\Models\Parametros\Empresa;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\Cxc\ValidacionFacturacion;
use App\Models\Cxc\Nabono;

class NabonoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('Super Administrador')) {
            $datas = Nabono::where('ven_tipo', 'A')->orderBy('ven_id')->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $ter = auth()->user()->Terminales->pluck('ter_id');
            $datas = Nabono::whereIn('ven_empresa', $emp)->whereIn('ven_terminal', $ter)->orderBy('ven_id')->get();
        }

        return view('cxc.ventas.documentos.nabono.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cxc.ventas.documentos.nabono.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionFacturacion $request)
    {
        // dd($request->all());
        try {
            DB::transaction(function () use ($request) {


                $fecha = Carbon::createFromFormat('d/m/Y', $request->ven_fecha);
                $request['ven_fecha'] = Carbon::parse($fecha)->format('Y-m-d H:i:s');
                $request['ven_fechaCert'] = Carbon::parse($fecha)->format('Y-m-d H:i:s');
                $Corr = getCorrelativo($fecha, $request->ven_empresa, $request-> ven_terminal, "Q");
                $request->merge(['ven_correlativoInt' => $Corr->corr_id]);
                $request->merge(['correlativoTexto' => $Corr->corr_correlativo]);


                $orden = Facturacion::create($request->all());
                $orden->ven_tipo = 'A';
                $orden->save();
                if (is_null($request->ven_iiud))
                $orden->ven_fechaCert = null;
                $orden->save();
            });
        } catch (Exception $e) {
            return redirect('cxc/ventas/documentos/nabono')->withErrors(['catch2', $e->getMessage()]);
        }
        return redirect('cxc/ventas/documentos/nabono')->with('mensajeHTML', "Nota de Abono creada con el correlativo")->with('correlativo', $request->correlativoTexto);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Facturacion::findOrFail($id);
        return view('cxc.ventas.documentos.nabono.mostrar', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = Nabono::findOrFail($id);
        return view('cxc.ventas.documentos.nabono.editar',compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
