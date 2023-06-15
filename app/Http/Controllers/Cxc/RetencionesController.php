<?php

namespace App\Http\Controllers\Cxc;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Cxc\Retenciones;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Cxc\DetalleRetencion;
use App\Http\Requests\Cxc\ValidacionRetenciones;

class RetencionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('Super Administrador')) {
            $datas = Retenciones::where('docv_formularioSAT', '1911')->orderBy('docv_id')->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $ter = auth()->user()->Terminales->pluck('ter_id');
            $datas = Retenciones::whereIn('docv_empresa', $emp)->whereIn('docv_terminal', $ter)->orderBy('docv_id')->get();
        }

        return view('cxc.ventas.documentos.retencion.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cxc.ventas.documentos.retencion.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

        public function store(ValidacionRetenciones $request)
    {
       //dd($request->all());
        try {
            DB::transaction(function () use ($request) {
                $fecha = Carbon::createFromFormat('d/m/Y', $request->docv_fecha);
                $request['docv_fecha'] = Carbon::parse($fecha)->format('Y-m-d H:i:s');
                $Corr = getCorrelativo($fecha, $request->docv_empresa, $request->docv_terminal, "I");
                $request->merge(['docv_correlativoInt' => $Corr->corr_id]);
                $request->merge(['correlativoTexto' => $Corr->corr_correlativo]);

               // dd($request->all());
                $orden = Retenciones::create($request->all());
                $orden->save();

                $detalle = new DetalleRetencion();
               $detalle->detr_doc = $orden->docv_id;
               $detalle->detr_doc = $orden->docv_id;
               $detalle->detr_factura = $request->detr_factura;
               $detalle->detr_retencion = $request->detr_retencion;
               $detalle->detr_tiporetencion = $request->detr_tiporetencion;
               $detalle->save();

                $detalle->save();

            });
        } catch (Exception $e) {
            return redirect('cxc/ventas/documentos/retencion')->withErrors(['catch2', $e->getMessage()]);
        }
        return redirect('cxc/ventas/documentos/retencion')->with('mensajeHTML', "Retención ISR creada con el correlativo")->with('correlativo', $request->correlativoTexto);
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
        return view('cxc.ventas.documentos.retencion.mostrar', compact('data'));
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
