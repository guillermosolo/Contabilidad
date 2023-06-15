<?php

namespace App\Exports\cyb;

use App\Models\cyb\CajaChica;
use App\Models\cyb\DetalleLiquidacionCC;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DetallesLiquidacionExport implements FromView,WithStyles,WithColumnWidths
{
    public $id;

    public function __construct($id)
    {
        $this->data =$id;
    }
    public function view(): View
    {
        $detalles = DetalleLiquidacionCC::where('dlcc_idcc',$this->data)->get();
        foreach($detalles as $detalle)
        {
            $detalle['dlcc_fecha'] = Carbon::parse($detalle['dlcc_fecha'])->format('d-m-Y');
        }
        $caja = CajaChica::find($this->data);
        $total = (new DetalleLiquidacionCC )->totalDetallesCajas($this->data);;
        $anterior= (new DetalleLiquidacionCC )->DetallesCompletos($this->data);;
        $fondos = 0;
        return view('cyb.cajas.liquidaciones.detalleexcel', compact('detalles','total','anterior','fondos','caja'));
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            5    => ['font' => ['bold' => true]],
            6    => ['font' => ['bold' => true]],

        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 20,
            'C' => 20,
            'D' => 75,
            'E' => 20,
            'F' => 70,
            'G' => 20,
        ];
    }
}
