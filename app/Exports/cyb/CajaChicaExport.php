<?php

namespace App\Exports\cyb;
use App\Models\cyb\CajaChica;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class CajaChicaExport implements FromView,WithColumnFormatting
{
    public function view(): View
    {
        $cajachicas= CajaChica::orderby('cch_id')->get();
        return view('cyb.cajas.responsables.excel', compact('cajachicas'));
    }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_NUMBER_00
            ];
    }
}
