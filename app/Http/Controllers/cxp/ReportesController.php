<?php

namespace App\Http\Controllers\cxp;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DocumentosRecibidosExport;

class ReportesController extends Controller
{
    public function recibidos()
    {
        return view('cxp.reportes.docrecibidos');
    }

    public function generar_recibidos(Request $request)
    {
        $fecha = explode(" al ",$request->fecha);
        $empresas = collect($request->empresa)->implode(',');
        $ssql = "";
        $terminales = null;
        $monedas = null;
        $tipoDoc = null;
        $inicio = null;
        $fin = null;
        if($request->terminal){
            $terminales = collect($request->terminal)->implode(',');
            $ssql .= " and ter_id in (" .$terminales .") ";
        }
        if($request->moneda){
            $monedas = collect($request->moneda)->implode(',');
            $ssql .= " and mon_id in (" .$monedas .") ";
        }
        if ($request->tipoDoc){
            $tipoDoc = collect($request->tipoDoc)->implode("','");
            $ssql .= " and tipo in ('" .$tipoDoc ."') ";
        }
        if ($request->fecha!=null){
            $inicio = Carbon::parse(Carbon::createFromFormat('d/m/Y',$fecha[0]))->format('Y-m-d');
            $fin =Carbon::parse(Carbon::createFromFormat('d/m/Y',$fecha[1]))->format('Y-m-d');
            $ssql .= " and fecha between '" . $inicio ."' AND '" . $fin . "'";
        }
        $params = (array('empresas' => $empresas, 'terminales' => $terminales, 'moneda' => $monedas, 'tipoDoc' => $tipoDoc, 'desde' => $inicio, 'hasta' => $fin));
        $datas = collect(DB::select(DB::raw("select * from
        (select com_id as id,'F' as tipo,com_fecha as fecha,per_nombre as proveedor,com_numDoc as numero, com_monto as monto,
         emp_siglas as empresa,ter_abreviatura as terminal,corr_correlativo as correlativo,corr_general as general,emp_id,ter_id,1 as mon_id,'Q'
          as moneda from compras,personas,correlativoint,empresa,terminal where com_persona = per_id and com_correlativoInt=corr_id
          and com_empresa = emp_id and com_terminal = ter_id
        union
        select poim_id as id, 'I' as tipo,poim_fecha as fecha,poim_proveedor as proveedor, poim_dua as numero, poim_fob as monto,
         emp_siglas as empresa, ter_abreviatura as terminal, corr_correlativo as correlativo,corr_general as general,emp_id,ter_id,mon_id, mon_simbolo
          as moneda from polizasimportacion,correlativoint,empresa,terminal,moneda	 where poim_correlativoInt = corr_id and
          poim_empresa = emp_id and poim_terminal = ter_id and poim_moneda = mon_id
        union
        select rec_id as id,'R' as tipo, rec_fecha as fecha, rec_nombre as proveedor, isnull(rec_numDoc,'S/N'),rec_monto as monto,
         emp_siglas as empresa, ter_abreviatura as terminal, corr_correlativo as correlativo,corr_general as general,emp_id,ter_id,mon_id,
          mon_simbolo as moneda from recibos,correlativoint,empresa,terminal,moneda where rec_correlativoInt= corr_id and
           rec_empresa = emp_id and rec_terminal = ter_id and rec_moneda = mon_id
        ) as documentos where emp_id in (" .$empresas .") " .$ssql ." order by emp_id,general")));
        return view('cxp.reportes.reprecibidos', compact('datas', 'params'));
    }

    public function exportarRecibidosExcel($empresas) //,$terminales,$monedas,$tipoDoc,$inicio,$fin)
    {
        return Excel::download(new DocumentosRecibidosExport($empresas), 'DocumentosRecibidos.xlsx');
    }

    public function exportarRecibidosPDF($empresas) //,$terminales,$monedas,$tipoDoc,$inicio,$fin)
    {
        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $ssql = "";
        $datas = collect(DB::select(DB::raw("select * from
        (select com_id as id,'F' as tipo,com_fecha as fecha,per_nombre as proveedor,com_numDoc as numero, com_monto as monto,
         emp_siglas as empresa,ter_abreviatura as terminal,corr_correlativo as correlativo,corr_general as general,emp_id,ter_id,1 as mon_id,'Q'
          as moneda from compras,personas,correlativoint,empresa,terminal where com_persona = per_id and com_correlativoInt=corr_id
          and com_empresa = emp_id and com_terminal = ter_id
        union
        select poim_id as id, 'I' as tipo,poim_fecha as fecha,poim_proveedor as proveedor, poim_dua as numero, poim_fob as monto,
         emp_siglas as empresa, ter_abreviatura as terminal, corr_correlativo as correlativo,corr_general as general,emp_id,ter_id,mon_id, mon_simbolo
          as moneda from polizasimportacion,correlativoint,empresa,terminal,moneda	 where poim_correlativoInt = corr_id and
          poim_empresa = emp_id and poim_terminal = ter_id and poim_moneda = mon_id
        union
        select rec_id as id,'R' as tipo, rec_fecha as fecha, rec_nombre as proveedor, isnull(rec_numDoc,'S/N'),rec_monto as monto,
         emp_siglas as empresa, ter_abreviatura as terminal, corr_correlativo as correlativo,corr_general as general,emp_id,ter_id,mon_id,
          mon_simbolo as moneda from recibos,correlativoint,empresa,terminal,moneda where rec_correlativoInt= corr_id and
           rec_empresa = emp_id and rec_terminal = ter_id and rec_moneda = mon_id
        ) as documentos where emp_id in (" .$empresas .") " .$ssql ." order by emp_id,general")));
        $pdf->loadView('cxp.reportes.PDF.documentosRecibidos', compact('datas'))->setPaper('letter', 'landscape');
        return $pdf->download('DocumentosRecibidos.pdf');
    }
}
