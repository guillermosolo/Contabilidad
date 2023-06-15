<?php

namespace App\Http\Controllers\Cxc;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Cxc\Retenciones;
use App\Models\Cxc\RetencionesIVA;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Cxc\DetalleRetencion;

use App\Http\Requests\Cxc\ValidacionRetencionesIVA;

class RetencionesIVAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('Super Administrador')) {
            $datas = Retenciones::where('docv_formularioSAT', '2229')->orderBy('docv_id')->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $ter = auth()->user()->Terminales->pluck('ter_id');
            $datas = Retenciones::whereIn('docv_empresa', $emp)->whereIn('docv_terminal', $ter)->orderBy('docv_id')->get();
        }

        return view('cxc.ventas.documentos.retencionIVA.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cxc.ventas.documentos.retencionIVA.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

        public function store(ValidacionRetencionesIVA $request)
    {
       // dd($request->all());
        try {
            DB::transaction(function () use ($request) {
                $fecha = Carbon::createFromFormat('d/m/Y', $request->docv_fecha);
                $request['docv_fecha'] = Carbon::parse($fecha)->format('Y-m-d H:i:s');
                $Corr = getCorrelativo($fecha, $request->docv_empresa, $request->docv_terminal, "I");
                $request->merge(['docv_correlativoInt' => $Corr->corr_id]);
                $request->merge(['correlativoTexto' => $Corr->corr_correlativo]);



                $orden = RetencionesIVA::create($request->all());

                foreach ($request->detr_factura as $i => $item) {
                    $detalle = new DetalleRetencion();
                    $detalle->detr_doc = $orden->docv_id;
                    $detalle->detr_factura = $item;
                    $detalle->detr_retencion = $request->detr_retencion[$i];
                    $detalle->detr_tiporetencion = $request->detr_tiporetencion[$i];
                    $detalle->save();
                }
            });
        } catch (Exception $e) {
            return redirect('cxc/ventas/documentos/retencionIVA')->withErrors(['catch2', $e->getMessage()]);
        }
        return redirect('cxc/ventas/documentos/retencionIVA')->with('mensajeHTML', "Retención de IVA creada con el correlativo")->with('correlativo', $request->correlativoTexto);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Retenciones::findOrFail($id);
        return view('cxc.ventas.documentos.retencionIVA.mostrar', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
