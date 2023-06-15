<?php

namespace App\Http\Controllers\cyb;

use App\Http\Controllers\Controller;
use App\Models\Admin\CorrelativoInterno;
use App\Models\cyb\Anticipos;
use App\Models\cyb\CajaChica;
use App\Models\cyb\Cheque;
use App\Models\cyb\Conciliaciones;
use App\Models\cyb\CuentasBancarias;
use App\Models\cyb\DetalleLiquidacionCC;
use App\Models\cyb\LiquidacionCC;
use App\Models\cyb\Transacciones;
use App\Models\Parametros\Empresa;
use App\Models\Planilla\Empleado;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use NumberFormatter;

class PDFController extends Controller
{
    public function PDFCB($dato=null){
        if ($dato) {
            $empresa=Empresa::findOrFail($dato)->emp_siglas;
            $cuentasbancariass = CuentasBancarias::where('ctab_empresa', $dato)->get();
        } else {
            $empresa= 'Todas las Empresas';
            $cuentasbancariass = CuentasBancarias::orderby('ctab_empresa');
            if (auth()->user()->hasRole('Super Administrador')) {
                $cuentasbancariass = $cuentasbancariass->get();
            } else {
                $emp = auth()->user()->Empresas->pluck('emp_id');
                $cuentasbancariass = $cuentasbancariass->whereIn('ctab_empresa', $emp)->get();
            }
        };

        $pdf = \PDF::loadview('cyb.bancos.cuentasbancarias.prueba', compact('cuentasbancariass', 'empresa'));
        return $pdf->download('Cuentas Bancarias.pdf');
    }

    public function PDFCC(){
        $cajachicas = CajaChica::all();
        $empleado = Empleado::all();
        $pdf = \PDF::loadview('cyb.cajas.responsables.pdf', compact('cajachicas', 'empleado'));
        return $pdf->download('Cajas Chicas.pdf');
    }



    public function chequePDF($tipo,$id){
        $formatterES = new NumberFormatter("es", NumberFormatter::SPELLOUT);
        $cheque = Cheque::find($id);
        $fecha = Carbon::parse($cheque->che_fecha);
        $cuentaid = $cheque->che_cuentabancaria;
        $cuentabancaria = CuentasBancarias::find($cuentaid);
        $decimales = explode(".", number_format($cheque->che_monto, 2, ".", ""));
        if($cuentabancaria->ctab_moneda == 1){
        $total_letras = ucfirst($formatterES->format($decimales[0])) . ' quetzales con ' . $decimales[1] . '/100';
        }else{
            $total_letras = ucfirst($formatterES->format($decimales[0])) . ' dólares con ' . $decimales[1] . '/100';
        }
        $data = ['lugar' => 'Guatemala,', 'beneficiario' => $cheque->che_beneficiario,
            'fecha' => $fecha->format('d') ." de ".strtolower(Str::nombreMes(intval($fecha->format('m')) )) .' del '. $fecha->format('Y'),
            'totalNumeros' => $cheque->che_monto
            , 'totalLetras' => $total_letras,
            'negociable' => $cheque->che_negociable,

        ];
        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $urlView = 'cyb.bancos.cheque.';
        $url = $urlView . ($tipo == 1 ? 'industrial' : ($tipo == 2 ? 'banrural' : 'interbanco'));
        $pdf->loadView($url, ['data' => $data])->setPaper('letter', 'portrait');
        $name = 'Cheque ' . $tipo . '.pdf';
        return $pdf->stream($name);
    }

    public function ChequeBanrural($id){
        $cheque = Cheque::find($id);
        $pdf = \PDF::loadview('cyb.bancos.transferencias.terceros.banruralpdf', compact('cheque'));
        return $pdf->stream('Cheque.pdf');
    }

    public function IndustrialBanrural($id){
        $cheque = Cheque::find($id);
        $pdf = \PDF::loadview('cyb.bancos.transferencias.terceros.industrialpdf', compact('cheque'));
        return $pdf->download('Cheque.pdf');
    }

    public function InterBanrural($id){
        $cheque = Cheque::find($id);
        $pdf = \PDF::loadview('cyb.bancos.transferencias.terceros.interpdf', compact('cheque'));
        return $pdf->download('Cheque.pdf');
    }

    public function liquidCajaChica(Request $request){
    $liquid = $request->get('search');
    $liquid = Carbon::parse(Carbon::createFromFormat('d/m/Y', $liquid))->format('Y-m-d');
        if (auth()->user()->hasRole('Super Administrador')) {
            $cajaschicas = CajaChica::orderBy('cch_id')->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $cajaschicas = CajaChica::orderBy('cch_id')->whereIn('cch_empresa', $emp)->get()->pluck('cch_id');
        }
    $liquidaciones = LiquidacionCC::where('lcc_fecha', '>=', $liquid)
    ->where('lcc_pendiente', 0)->whereIn('lcc_cajachica', $cajaschicas)->get();
    if($liquidaciones->count()==0){
        return redirect()->route('autorizar')->withErrors(['No hay cajas Liquidadas', 'No se encontraron Registros para esta fecha.']);
    }else{
        $pdf = \PDF::loadview('cyb.cajas.autorizacion.ccpdf', compact('liquidaciones'));
        return $pdf->download('Cajas Chicas Autorizadas.pdf');
    }
    }

    public function liquidAnticipo(Request $request){
        $liquid = $request->get('search');
        $liquid = Carbon::parse(Carbon::createFromFormat('d/m/Y', $liquid))->format('Y-m-d');
        if (auth()->user()->hasRole('Super Administrador'))
        {
            $anticipos = Anticipos::orderBy('ant_id')->where('ant_fecha', '>=', $liquid)->get();
        }else
        {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $terAuth = auth()->user()->Terminales->pluck('ter_id');
            $cuentas = CuentasBancarias::orderBy('ctab_id')->whereIn('ctab_empresa', $emp)->get()->pluck('ctab_id');
            $corr = CorrelativoInterno::whereIn('corr_terminal', $terAuth)->get()->pluck('corr_id');
            $cheque = Cheque::orderBy('che_id')->whereIn('che_cuentabancaria', $cuentas)->whereIn('che_correlativoInt', $corr)->get()->pluck('che_id');
            $anticipos = Anticipos::orderBy('ant_id')->whereIn('ant_cheque', $cheque)->where('ant_fecha', '>=', $liquid)->get();
        }
        if($anticipos->count()==0){
            return redirect()->route('liquidar')->withErrors(['No hay Anticipos Liquidados', 'No se encontraron Registros para esta fecha.']);
        }else{
            $pdf = \PDF::loadview('cyb.bancos.anticipos.liquidar.antpdf', compact('anticipos'));
            return $pdf->download('Anticipos Liquidados.pdf');
        }
    }
    public function conciliadospdf(Request $request){
        $liquid = $request->get('search');
        $liquid2 = $request->get('search2');
        if($liquid2 == '09'){
            $liquid2 = '9';
        }
        $transacciones = Conciliaciones::where('con_mes', $liquid2)->where('con_anio', $liquid)->get();

        if($transacciones->count()==0){
            return redirect()->route('conciliaciones')->withErrors(['No hay Transacciones Liquidadas', 'No se encontraron Registros para esta fecha.']);
        }else{
            $pdf = \PDF::loadview('cyb.bancos.conciliaciones.conciliacion.conciliadospdf', compact('transacciones'));
            return $pdf->download('Transacciones Conciliadas.pdf');
        }
    }
    public function detalleLiquidacion($id){
        $detalles = DetalleLiquidacionCC::where('dlcc_idcc',$id)->get();
        foreach($detalles as $detalle)
        {
            $detalle['dlcc_fecha'] = Carbon::parse($detalle['dlcc_fecha'])->format('d-m-Y');
        }
        $caja = CajaChica::find($id);
        $total = (new DetalleLiquidacionCC )->totalDetallesCajas($id);
        $anterior= (new DetalleLiquidacionCC )->DetallesCompletos($id);
        $fondos = 0;
        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        if($detalles->count()==0){
            return redirect()->back()->withErrors(['Error', 'No se encontraron Registros para esta Liquidacion']);
        }else{
            $pdf->loadView('cyb.cajas.liquidaciones.pdf', ['caja'=>$caja,'detalles' => $detalles, 'total' => $total, 'anterior' => $anterior,'fondos'=>$fondos])->setPaper('letter', 'landscape');
            return $pdf->download('DetalleLiquidacionCC.pdf');
        }

    }

}
