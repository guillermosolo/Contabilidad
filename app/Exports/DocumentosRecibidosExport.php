<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class DocumentosRecibidosExport implements FromCollection,ShouldAutoSize,WithHeadings, WithMapping,WithColumnFormatting,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($empresas)
    {
        $this->empresas = $empresas;
    }

    public function map($datas): array
    {
        return [
            $datas->id,
            $datas->tipo,
            Date::dateTimeToExcel(Carbon::createFromFormat('Y-m-d', $datas->fecha)),
            $datas->proveedor,
            $datas->numero,
            $datas->monto,
            $datas->empresa,
            $datas->terminal,
            $datas->correlativo,
            $datas->general,
            $datas->emp_id,
            $datas->moneda
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'E' => '#0',
            'F' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tipo',
            'Fecha',
            'Proveedor',
            'Número de Documento',
            'Monto',
            'Empresa',
            'Terminal',
            'Correlativo Interno',
            'General',
            'Codigo Empresa',
            'Moneda'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
           // 'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
           // 'C'  => ['font' => ['size' => 16]],
        ];
    }

    public function collection()
    {
        $empresas = $this->empresas;
        $datas = collect(DB::select(DB::raw("select * from
        (select com_id as id,'F' as tipo,com_fecha as fecha,per_nombre as proveedor,com_numDoc as numero, com_monto as monto, emp_siglas as empresa,ter_abreviatura as terminal,corr_correlativo as correlativo,corr_general as general,emp_id,'Q' as moneda from compras,personas,correlativoint,empresa,terminal where com_persona = per_id and com_correlativoInt=corr_id and com_empresa = emp_id and com_terminal = ter_id and com_empresa in (".$empresas.")
        union
        select poim_id as id, 'I' as tipo,poim_fecha as fecha,poim_proveedor as proveedor, poim_dua as numero, poim_fob as monto, emp_siglas as empresa, ter_abreviatura as terminal, corr_correlativo as correlativo, corr_general as general,emp_id, mon_simbolo as moneda from polizasimportacion,correlativoint,empresa,terminal,moneda	 where poim_correlativoInt = corr_id and poim_empresa = emp_id and poim_terminal = ter_id and poim_moneda = mon_id and poim_empresa in (".$empresas.")
        union
        select rec_id as id,'R' as tipo, rec_fecha as fecha, rec_nombre as proveedor, isnull(rec_numDoc,'S/N'),rec_monto as monto, emp_siglas as empresa, ter_abreviatura as terminal, corr_correlativo as correlativo,corr_general as general,emp_id, mon_simbolo as moneda from recibos,correlativoint,empresa,terminal,moneda where rec_correlativoInt= corr_id and rec_empresa = emp_id and rec_terminal = ter_id and rec_moneda = mon_id and rec_empresa in (".$empresas.")
        ) as documentos order by emp_id,general")));
        return $datas;
    }
}
