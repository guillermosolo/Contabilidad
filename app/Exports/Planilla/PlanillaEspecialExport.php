<?php

namespace App\Exports\Planilla;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PlanillaEspecialExport implements FromView,WithColumnFormatting
{
    public $data,$total,$dataPlanilla;

    public function __construct($data)
    {
        $this->data = $data['datas'];
        $this->total = $data['total'];
    }
    public function view(): View
    {
        return view('planillas.generacion.exports.especial.excel', [
            'datas' => $this->data,'total'=>$this->total
        ]);

    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }
}
