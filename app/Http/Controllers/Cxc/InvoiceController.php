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
use App\Models\Cxc\Invoice;
use Barryvdh\DomPDF\Facade as PDF;



class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if (auth()->user()->hasRole('Super Administrador')) {
            $datas = Facturacion::where('ven_tipo', 'I')->orderBy('ven_id')->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $ter = auth()->user()->Terminales->pluck('ter_id');
            $datas = Facturacion::whereIn('ven_empresa', $emp)->whereIn('ven_terminal', $ter)->orderBy('ven_id')->get();
        }
        return view('cxc.ventas.invoice.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cxc.ventas.invoice.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionFacturacion $request)
    {
        try {

            DB::transaction(function () use ($request) {
                //throw new Exception("esto es un error");
                $fecha = Carbon::createFromFormat('d/m/Y', $request->ven_fecha);
                $request['ven_fecha'] = Carbon::parse($fecha)->format('Y-m-d H:i:s');
                $Corr = getCorrelativo($fecha, $request->ven_empresa, $request->ven_terminal, "I");
                $request->merge(['ven_correlativoInt' => $Corr->corr_id]);
                $request->merge(['correlativoTexto' => $Corr->corr_correlativo]);

                $orden = Facturacion::create($request->all());
                if (is_null($request->ven_iiud))
                    $orden->ven_fechaCert = null;
                $orden->save();
                $orden->ven_tipo = 'I';
                $orden->save();

                foreach ($request->detv_producto as $i => $item) {
                    $detalle = new DetalleVentas();
                    $detalle->detv_venta = $orden->ven_id;
                    $detalle->detv_producto = $item;
                    $detalle->detv_precioU = $request->detv_precioU[$i];
                    $detalle->detv_cantidad = $request->detv_cantidad[$i];
                    if (is_null($detalle->detv_descuento))
                    $detalle->detv_descuento = '0';
                    $detalle->save();
                }
            });
        } catch (Exception $e) {
            return redirect('cxc/ventas/invoice')->withErrors(['catch2', $e->getMessage()]);
        }
        return redirect('cxc/ventas/invoice')->with('mensajeHTML', "Invoice creada con el correlativo")->with('correlativo', $request->correlativoTexto);
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
       // return view('cxc.ventas.facturacion.vistafactura1', compact('data'));
        return view('cxc.ventas.invoice.mostrar', compact('data'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Facturacion::findOrFail($id);

        return view('cxc.ventas.invoice.editar', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {


        return redirect('cxc/ventas/invoice')->with('mensaje', 'Invoice anulada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function FacturaPDF()
    {

        $data = Facturacion::findOrFail(2);
        //return view ('cxc.ventas.facturacion.vistafactura1',compact('data'));
        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('cxc.ventas.invoice.vistafactura1', compact('data'))->setPaper('letter');
       return $pdf->download('Facturas.pdf');
    }





}





