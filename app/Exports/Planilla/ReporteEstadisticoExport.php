<?php

namespace App\Exports\Planilla;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReporteEstadisticoExport implements FromView,WithColumnFormatting,WithStyles,WithEvents
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    public function view(): View
    {
        return view('planillas.reportes.estadistico.exports.excel', [
            'datas' => $this->data
        ]);

    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:AT1')->getFont()->setBold(true);
    }
    public function registerEvents(): array
    {
        return [
            BeforeWriting::class => function(BeforeWriting $event) {
                $event->writer->reopen(new  LocalTemporaryFile(public_path('/files/informe.xlsx')), Excel::XLSX);
                $event->writer->getSheetByIndex(1);
                $event->writer->getSheetByIndex(1)->export($event->getConcernable()); // call the export on the first sheet
                return $event->getWriter()->getSheetByIndex(1);
            },

        ];
    }
    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_NUMBER,
            'G' => NumberFormat::FORMAT_NUMBER,
            'H' => NumberFormat::FORMAT_NUMBER,
            'L' => NumberFormat::FORMAT_NUMBER,
            'J' => NumberFormat::FORMAT_NUMBER,
            'K' => NumberFormat::FORMAT_NUMBER,
            'M' => NumberFormat::FORMAT_NUMBER,
            'N' => NumberFormat::FORMAT_NUMBER,
            'O' => NumberFormat::FORMAT_NUMBER,
            'P' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'Q' => NumberFormat::FORMAT_NUMBER,
            'S' => NumberFormat::FORMAT_NUMBER,
            'T' => NumberFormat::FORMAT_NUMBER,
            'V' => NumberFormat::FORMAT_NUMBER,
            'X' => NumberFormat::FORMAT_NUMBER,
            'Y' => NumberFormat::FORMAT_NUMBER,
            'Z' => NumberFormat::FORMAT_NUMBER,
            'AA' => NumberFormat::FORMAT_NUMBER,
            'AB' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AC' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AD' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AE' => NumberFormat::FORMAT_NUMBER,
            'AF' => NumberFormat::FORMAT_NUMBER,
            'AG' => NumberFormat::FORMAT_NUMBER,
            'AI' => NumberFormat::FORMAT_NUMBER_00,
            'AJ' => NumberFormat::FORMAT_NUMBER_00,
            'AK' => NumberFormat::FORMAT_NUMBER_00,
            'AL' => NumberFormat::FORMAT_NUMBER,
            'AM' => NumberFormat::FORMAT_NUMBER_00,
            'AN' => NumberFormat::FORMAT_NUMBER_00,
            'AO' => NumberFormat::FORMAT_NUMBER_00,
            'AP' => NumberFormat::FORMAT_NUMBER_00,
            'AQ' => NumberFormat::FORMAT_NUMBER_00,
            'AR' => NumberFormat::FORMAT_NUMBER_00,
            'AS' => NumberFormat::FORMAT_NUMBER_00,
            'AT' => NumberFormat::FORMAT_NUMBER_00,

        ];
    }
}
