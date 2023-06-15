<?php

namespace App\Imports;

use App\Models\cyb\ConciliacionImport;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ConciliacionesImport implements ToModel,WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ConciliacionImport([
            'registro' => $row['Registro'],
            'cuenta_bancaria' => $row['Cuenta Bancaria'],
            'fecha' => $row['Fecha'],
            'referencia' => $row['Referencia'],
            'concepto' => $row['Concepto'],
            'monto' => $row['Monto'],

        ]);
    }
    public function prepareForValidation($data, $index)
    {

        return [
            'registro'=>$data['registro'],
            'cuenta_bancaria'=>$data['cuenta_bancaria'],
            'fecha'=>Date::excelToDateTimeObject($data['fecha'])->format('Y-m-d'),
            'referencia'=>   $data['referencia'],
            'concepto'=>$data['concepto'],
            'monto'=> $data['monto'],

        ];
        //...
    }
    public function rules(): array
    {
        return [
            'fecha'=>'required|date_format:Y-m-d',
            //..
        ];
    }
}
