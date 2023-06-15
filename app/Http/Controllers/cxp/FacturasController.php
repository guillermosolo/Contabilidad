<?php

namespace App\Http\Controllers\cxp;

use Exception;
use Carbon\Carbon;
use App\Models\cxp\Compras;
use Illuminate\Http\Request;
use App\Models\cxp\DetalleCompras;
use App\Models\Contabilidad\CuentaContable;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\cxp\PagosProveedores;
use App\Models\Admin\DocumentosVarios;
use App\Http\Requests\cxp\ValidacionFacturas;

class FacturasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('Super Administrador')) {
            $datas = Compras::orderBy('com_id')->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $ter = auth()->user()->Terminales->pluck('ter_id');
            $datas = Compras::whereIn('com_empresa', $emp)->whereIn('com_terminal', $ter)->orderBy('com_id')->get();
        }
        return view('cxp.facturas.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cxp.facturas.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionFacturas $request)
    {
        if (!($request->com_retencion)) {
            $request->merge(['com_retencion' => '0']);
        }
        if (!($request->com_peqcontribuyente)) {
            $request->merge(['com_peqcontribuyente' => '0']);
        }
        if(!($request->aplicaExcento)){
            $request->merge(['com_ctaExcento' => '1']);
            $request->merge(['com_excento' => '0']);
        }
        $prev = "";
        $b = 0;
        foreach ($request->dettipoGasto as $item){
           $cta = CuentaContable::find($item);
           $cod = $cta->cta_codigo;
           if ($cod[0]==5 || $cod[0]==7){
                 $ter = substr($cod,2,2);
                 if ($prev != $ter){
                     $b+= 1;
                     $prev = $ter;
                 }
           }
        }
        try {
           DB::transaction(function () use ($request,$b) {
                $fecha = Carbon::createFromFormat('d/m/Y', $request->com_fecha);
                $request['com_fecha'] = Carbon::parse($fecha)->format('Y-m-d H:i:s');
                if ($b>1)
                    $Corr = getCorrelativo($fecha, $request->com_empresa, "XX", "G");
                else
                    $Corr = getCorrelativo($fecha, $request->com_empresa, $request->com_terminal, "G");
                $request->merge(['com_correlativoInt' => $Corr->corr_id]);
                $request->merge(['correlativoTexto' => $Corr->corr_correlativo]);
                $factura = Compras::create($request->all());
                foreach ($request->detCantidad as $i => $item) {
                    $detalle = new DetalleCompras;
                    $detalle->detc_documento = $factura->com_id;
                    $detalle->detc_descripcion = $request->detDescripcion[$i];
                    $detalle->detc_precioU = $request->detprecioU[$i];
                    $detalle->detc_cantidad = $request->detCantidad[$i];
                    $detalle->detc_tipoGasto = $request->dettipoGasto[$i];
                    if (is_null($request->dettipoComb[$i]))
                        $detalle->detc_tipoComb = null;
                    else
                        $detalle->detc_tipoComb = $request->dettipoComb[$i];
                    $detalle->save();
                }
                if ($request->aplicaActivo) {
                    $factura->Activo()->attach($request->facturaActivo, ['af_tipoDoc' => 'F']);
                }
                if ($request->com_retencion) {
                    $montoRet = 0;
                    if ($request->com_monto > 2800 && $request->com_monto <= 30000) {
                        $montoRet = (+$request->com_monto / 1.12) * 0.05;
                    } else if ($request->com_monto > 30000) {
                        $montoRet = (((+$request->com_monto / 1.12) - 30000) * 0.07) + 1500;
                    }
                    if ($montoRet > 0) {
                        $retencionISR = new DocumentosVarios;
                        $fecha = Carbon::createFromFormat('d/m/Y', $request->fechaRetencion);
                        $retencionISR->docv_fecha = Carbon::parse($fecha)->format('Y-m-d H:i:s');
                        $retencionISR->docv_formularioSAT = '1911';
                        $retencionISR->docv_numero = $request->numeroRetencion;
                        $retencionISR->docv_persona = $request->com_empresa;
                        $retencionISR->docv_monto = $montoRet;
                        $retencionISR->docv_empresa = $request->com_empresa;
                        $retencionISR->docv_terminal = $request->com_terminal;
                        $retencionISR->docv_correlativoInt = 1;
                        $retencionISR->docv_tipo = 'P';
                        $retencionISR->save();
                        $pago = new PagosProveedores;
                        $pago->pap_documento = $factura->com_id;
                        $pago->pap_tipoDoc = 'F';
                        $pago->pap_monto = $montoRet;
                        $pago->pap_tipoPago = 2;
                        $pago->pap_referencia = $retencionISR->docv_id;
                        $pago->pap_fecha = $fecha;
                        $pago->save();
                    }
                }
            });
        } catch (Exception $e) {
            return redirect('cxp/facturas')->withErrors(['catch2', $e->errorInfo]);
        }
        return redirect('cxp/facturas')->with('mensajeHTML', "Factura creada con el correlativo")->with('correlativo', $request->correlativoTexto);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Compras::findOrFail($id);
            $pagos = PagosProveedores::where('pap_documento', $data->com_id)->where('pap_tipoDoc','F')->get();
            return view('cxp.facturas.mostrar', compact('data','pagos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
