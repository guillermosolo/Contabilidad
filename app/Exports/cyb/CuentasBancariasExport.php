<?php

namespace App\Exports\cyb;
use App\Models\cyb\CuentasBancarias;
use App\Models\Parametros\Empresa;
use http\Env\Request;
use Maatwebsite\Excel\Cell;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Sabberworm\CSS\Value\Size;
use Maatwebsite\LaravelNovaExcel\Actions\ExportToExcel;
use Maatwebsite\Excel\Concerns\WithColumnWidths;


class CuentasBancariasExport implements FromView,WithColumnFormatting,WithColumnWidths
{
    public $dato;

    public function __construct($dato)
    {
        $this->data =$dato;
    }

    public function  view(): View
    {

        if ($this->data>0) {
            $cuentasbancariass = CuentasBancarias::where('ctab_empresa', $this->data)->get();
        } else {
            $cuentasbancariass = CuentasBancarias::orderby('ctab_empresa');
            if (auth()->user()->hasRole('Super Administrador')) {
                $cuentasbancariass = $cuentasbancariass->orderBy('ctab_id')->get();
            } else {
                $emp = auth()->user()->Empresas->pluck('emp_id');
                $cuentasbancariass = $cuentasbancariass->orderBy('ctab_id')->whereIn('ctab_empresa', $emp)->get();
            }
        };
        return view('cyb.bancos.cuentasbancarias.excel', compact('cuentasbancariass'));
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'B' => 20,
        ];
    }

}
