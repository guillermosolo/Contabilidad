<?php

namespace App\Http\Controllers\Cxc;

use Exception;
use Carbon\Carbon;
use App\Models\Admin\Moneda;
use Illuminate\Http\Request;
use App\Models\Admin\Persona;
use App\Models\Cxc\Productos;
use Illuminate\Routing\Route;
use App\Models\Cxc\Facturacion;
use App\Models\Cxc\DetalleVentas;
use App\Models\Parametros\Empresa;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;
use App\Models\Admin\CorrelativoInterno;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Cxc\ValidacionFacturacion;



class FacturacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('Super Administrador')) {
            $datas = Facturacion::where('ven_tipo', 'F')->orderBy('ven_id')->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $ter = auth()->user()->Terminales->pluck('ter_id');
            $datas = Facturacion::whereIn('ven_empresa', $emp)->whereIn('ven_terminal', $ter)->orderBy('ven_id')->get();
        }
        return view('cxc.ventas.facturacion.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cxc.ventas.facturacion.crear');
    }


    public function Vista()
    {
        return view('cxc.ventas.facturacion.vista');
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


            // dd($request->all());
            DB::transaction(function () use ($request) {

                $xml = Self::crearXML($request);
                $url = 'https://certificador.feel.com.gt/fel/procesounificado/transaccion/v2/xml';
                $fecha = Carbon::createFromFormat('d/m/Y', $request->ven_fecha);
                $request['ven_fecha'] = Carbon::parse($fecha)->format('Y-m-d H:i:s');
                $request['ven_fechaCert'] = Carbon::parse($fecha)->format('Y-m-d H:i:s');
                $Corr = getCorrelativo($fecha, $request->ven_empresa, $request->ven_terminal, "Q");
                $headers = [
                    'UsuarioFirma' => Config::get('credenciales.1.UsuarioFirma'),
                    'LlaveFirma' => Config::get('credenciales.1.LlaveFirma'),
                    'UsuarioApi' => Config::get('credenciales.1.UsuarioApi'),
                    'LlaveApi' => Config::get('credenciales.1.LlaveApi'),
                    'identificador' => $Corr->corr_correlativo,
                ];
                $response = Http::withHeaders($headers)->send('POST', $url, ['body' => $xml]);


                //dd($response->json());


                /* $response->json()['fecha'];
                $response->json()['uuid'];
                $response->json()['serie'];
                $response->json()['numero'];*/

                //dd($request->all($response))
                //$response->json()['resultado'];






                if ($response->json()['resultado'] == 0) {
                    $error = $response->json()['descripcion_errores'];
                    //dd($error[0]['mensaje_error']);
                    throw new Exception($error[0]['mensaje_error']);
                }

                $request->merge(['ven_correlativoInt' => $Corr->corr_id]);
                $request->merge(['correlativoTexto' => $Corr->corr_correlativo]);

                //dd($request->all());

                $orden = Facturacion::create($request->all());

                $orden->ven_fechaCert = $response->json()['fecha'];
                $orden->ven_iiud = $response->json()['uuid'];
                $orden->ven_serie = $response->json()['serie'];
                $orden->ven_numDoc = $response->json()['numero'];

                $orden->ven_enlacefactura = "https://report.feel.com.gt/ingfacereport/ingfacereport_documento?uuid=" . $response->json()['uuid'];
                $orden->save();
                $orden->ven_tipo = 'F';
                $orden->save();
                // if (is_null($request->ven_iiud))
                // $orden->ven_fechaCert = null;
                $orden->save();
                foreach ($request->detv_producto as $i => $item) {
                    $detalle = new DetalleVentas();
                    $detalle->detv_venta = $orden->ven_id;
                    $detalle->detv_producto = $item;
                    $detalle->detv_precioU = $request->detv_precioU[$i] * 1.12;
                    $detalle->detv_cantidad = $request->detv_cantidad[$i];
                    if (is_null($detalle->detv_descuento))
                        $detalle->detv_descuento = '0';
                    $detalle->save();
                }

                $urlf = $orden->ven_enlacefactura = "https://report.feel.com.gt/ingfacereport/ingfacereport_documento?uuid=" . $response->json()['uuid'];
                $request->merge(['urlf' => $urlf]);
            });
        } catch (Exception $e) {
            return redirect('cxc/ventas/facturacion')->withErrors(['catch2', $e->getMessage()]);
        }
        return redirect('cxc/ventas/facturacion/vista')->with('mensajeHTML', "Factura creada con el correlativo")->with('correlativo', $request->correlativoTexto)->with('urlf',$request->urlf);
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
        return view('cxc.ventas.facturacion.mostrar', compact('data'));
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

        return view('cxc.ventas.facturacion.editar', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionFacturacion $request, $id)
    {
        Facturacion::findOrFail($id)->update($request->all());
        return redirect('cxc/ventas/facturacion')->with('mensaje', 'Factura actualizada correctamente.');
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
        $pdf->loadView('cxc.ventas.facturacion.vistafactura1', compact('data'))->setPaper('letter');
        return $pdf->download('Facturas.pdf');
    }








    static function crearXML(request $request)
    {

        $empresa = new Empresa();
        $cliente = new Persona();
        $moneda = new Moneda();
        $producto = new Productos();
        $correlativo = new CorrelativoInterno();

        $nit = $empresa->getNit($request->ven_empresa);
        $nComercial = $empresa->getNComercial($request->ven_empresa);
        $nombreEmp = $empresa->getNombre($request->ven_empresa);
        $direccionEmp = $empresa->getDireccion($request->ven_empresa);
        $municipioEmp = $empresa->getMunicipio($request->ven_empresa);
        $siglaMon = $moneda->getSigla($request->ven_moneda);
        $Corr = $correlativo->Correlativo($request->ven_correlativoInt);
        $nitCli = $cliente->getNit($request->ven_persona);
        $emailCli = $cliente->getEmail($request->ven_persona);
        $nombreCli = $cliente->getNombreCli($request->ven_persona);
        $direccionCli = $cliente->getDireccionCli($request->ven_persona);
        $datetime = Carbon::createFromFormat('d/m/Y', $request->ven_fecha);
        $Atom = $datetime->toAtomString();
        $tipocambio = (($request->ven_tipoCambio));


        $xml =  <<<XML
            <dte:GTDocumento xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:dte="http://www.sat.gob.gt/dte/fel/0.2.0" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" Version="0.1" xsi:schemaLocation="http://www.sat.gob.gt/dte/fel/0.2.0">
            <dte:SAT ClaseDocumento="dte">
            <dte:DTE ID="DatosCertificados">
            <dte:DatosEmision ID="DatosEmision">
            <dte:DatosGenerales CodigoMoneda="$siglaMon" FechaHoraEmision="$Atom" Tipo="FACT"></dte:DatosGenerales>
            <dte:Emisor AfiliacionIVA="GEN" CodigoEstablecimiento="1" NITEmisor="11400055K" NombreComercial="$nComercial" NombreEmisor="$nombreEmp">
              <dte:DireccionEmisor>
                <dte:Direccion>$direccionEmp</dte:Direccion>
                <dte:CodigoPostal>01001</dte:CodigoPostal>
                <dte:Municipio>GUATEMALA</dte:Municipio>
                <dte:Departamento>GUATEMALA</dte:Departamento>
                <dte:Pais>GT</dte:Pais>
              </dte:DireccionEmisor>
            </dte:Emisor>
            <dte:Receptor CorreoReceptor="$emailCli" IDReceptor="$nitCli" NombreReceptor="$nombreCli">
              <dte:DireccionReceptor>
                <dte:Direccion>$direccionCli</dte:Direccion>
                <dte:CodigoPostal>01001</dte:CodigoPostal>
                <dte:Municipio>GUATEMALA</dte:Municipio>
                <dte:Departamento>GUATEMALA</dte:Departamento>
                <dte:Pais>GT</dte:Pais>
              </dte:DireccionReceptor>
            </dte:Receptor>
            <dte:Frases>
              <dte:Frase CodigoEscenario="1" TipoFrase="1"></dte:Frase>
            </dte:Frases>
            <dte:Items>
            XML;

        $total = 0;
        $totiva = 0;
        foreach ($request->detv_producto as $i => $item) {

            $pU = round($request->detv_precioU[$i], 5);
            $pU2 = round($pU * 0.12, 5);
            $pU3 = $pU + $pU2;
            $pU4 = round($pU3 * $tipocambio, 5);

            $cantidad = round($request->detv_cantidad[$i], 5);



            $totalq = round($pU4 * $cantidad, 5);



            $iva = round($totalq / 1.12, 5);



            $iva2 = $totalq - $iva;



            $total += $totalq;
            $totiva += $iva2;






            $prod = $producto->getProducto($request->detv_producto[$i]);

            $xml .= <<<XML
            <dte:Item BienOServicio="S" NumeroLinea="1">
            <dte:Cantidad>$cantidad</dte:Cantidad>
            <dte:UnidadMedida>UND</dte:UnidadMedida>
            <dte:Descripcion>$prod</dte:Descripcion>
            <dte:PrecioUnitario>$pU4</dte:PrecioUnitario>
            <dte:Precio>$totalq</dte:Precio>
            <dte:Descuento>0.00</dte:Descuento>
            <dte:Impuestos>
              <dte:Impuesto>
                <dte:NombreCorto>IVA</dte:NombreCorto>
                <dte:CodigoUnidadGravable>1</dte:CodigoUnidadGravable>
                <dte:MontoGravable>$iva</dte:MontoGravable>
                <dte:MontoImpuesto>$iva2</dte:MontoImpuesto>
              </dte:Impuesto>
            </dte:Impuestos>
            <dte:Total>$totalq</dte:Total>
          </dte:Item>
          XML;
        }

        $xml .= <<<XML



        </dte:Items>
        <dte:Totales>
          <dte:TotalImpuestos>
            <dte:TotalImpuesto NombreCorto="IVA" TotalMontoImpuesto="$totiva"></dte:TotalImpuesto>
          </dte:TotalImpuestos>
          <dte:GranTotal>$total</dte:GranTotal>
        </dte:Totales>
      </dte:DatosEmision>
    </dte:DTE>
    <dte:Adenda>
      <Codigo_cliente>C01</Codigo_cliente>
      <Observaciones>Prueba</Observaciones>
      <Tasa-Cambio>$tipocambio</Tasa-Cambio>


       <Fact-Comen> $request->ven_descripcion
       $request->ven_referencia


    $request->ven_contenedores</Fact-Comen>

    <Referencia-Interna>06-ST-Z-10-21-00005-00006</Referencia-Interna>

    </dte:Adenda>
     </dte:SAT>
    </dte:GTDocumento>

    XML;
        return $xml;
    }



    static function anularFactura(Request $request)
    {



        $datetime = Carbon::createFromFormat('d/m/Y', $request->fecha);
        $Atom1 = $datetime->toAtomString();

        $datetime = Carbon::createFromFormat('d/m/Y', $request->fechacert);
        $Atom = $datetime->toAtomString();


        $xml =  <<<XML
            <dte:GTAnulacionDocumento xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:dte="http://www.sat.gob.gt/dte/fel/0.1.0" xmlns:n1="http://www.altova.com/samplexml/other-namespace" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" Version="0.1" xsi:schemaLocation="http://www.sat.gob.gt/dte/fel/0.1.0 C:\Users\User\Desktop\FEL\Esquemas\GT_AnulacionDocumento-0.1.0.xsd">
            <dte:SAT>
         <dte:AnulacionDTE ID="DatosCertificados">
            <dte:DatosGenerales FechaEmisionDocumentoAnular="$Atom1" FechaHoraAnulacion="$Atom" ID="DatosAnulacion" IDReceptor="$request->nit" MotivoAnulacion="PRUEBA DE ANULACIÓN" NITEmisor="11400055K" NumeroDocumentoAAnular="$request->iiud"></dte:DatosGenerales>
            </dte:AnulacionDTE>
            </dte:SAT>
       </dte:GTAnulacionDocumento>

    XML;
        return $xml;
    }


    public function Cancelar(Request $request, $id)
    {
        try { //dd($request->all());

            Facturacion::find($id)->update(['ven_anulada' => 0]);
            DB::transaction(function () use ($request) {
                //throw new Exception("esto es un error");

                //dd($request->all());


                $xml = Self::anularFactura($request);
                $url = 'https://certificador.feel.com.gt/fel/procesounificado/transaccion/v2/xml';

                $headers = [
                    'UsuarioFirma' => Config::get('credenciales.1.UsuarioFirma'),
                    'LlaveFirma' => Config::get('credenciales.1.LlaveFirma'),
                    'UsuarioApi' => Config::get('credenciales.1.UsuarioApi'),
                    'LlaveApi' => Config::get('credenciales.1.LlaveApi'),
                    'identificador' =>  $request->ven_correlativoInt,
                ];
                $response = Http::withHeaders($headers)->send('POST', $url, ['body' => $xml]);
                if ($response->json()['resultado'] == 0) {
                    $error = $response->json()['descripcion_errores'];
                    //dd($error[0]['mensaje_error']);
                    throw new Exception($error[0]['mensaje_error']);
                }



            });
        } catch (Exception $e) {
            return redirect('cxc/ventas/facturacion')->withErrors(['catch2', $e->getMessage()]);
        }
        return redirect('cxc/ventas/facturacion')->with('mensajeHTML', "Factura anulada correctamente");
    }



    public function Anular(Request $request, $id)
    {
        //dd($request->all());
        $data = Facturacion::findOrFail($id);




        return view('cxc.ventas.facturacion.anular', compact('data'));
    }


    public function Notas(Request $request, $emp, $ter, $cli)
    {
        if ($request->ajax()) {
            $act = Facturacion::where('ven_empresa', $emp)->where('ven_terminal', $ter)->where('ven_persona', $cli)->where('ven_tipo', 'LIKE', 'F')->get();
            return response()->json($act);
        } else {
            abort(404);
        }
    }


    public function Retencion(Request $request, $emp)
    {
        if ($request->ajax()) {
            $act = Facturacion::where('ven_empresa', $emp)->where('ven_tipo', 'LIKE', 'F')->get();
            return response()->json($act);
        } else {
            abort(404);
        }
    }
}
