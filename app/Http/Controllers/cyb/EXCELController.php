<?php

namespace App\Http\Controllers\cyb;

use App\Exports\cyb\CajaChicaExport;
use App\Exports\cyb\CuentasBancariasExport;
use App\Exports\cyb\DetallesLiquidacionExport;
use App\Http\Controllers\Controller;
use App\Models\cyb\DetalleLiquidacionCC;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EXCELController extends Controller
{
    public function EXCELCC(){
        return Excel::download(new CajaChicaExport(), 'Caja Chica.xlsx');
    }

    public function EXCELCB($dato){
            return Excel::download(new CuentasBancariasExport($dato), 'Cuentas Bancarias.xlsx');
    }

    public function EXCELDLCC($id){

        $detalles = DetalleLiquidacionCC::where('dlcc_idcc',$id)->get();
        if($detalles->count()==0){
            return redirect()->back()->withErrors(['Error', 'No se encontraron Registros para esta Liquidacion']);
        }else{
            return Excel::download(new DetallesLiquidacionExport($id), 'Detalles.xlsx');
        }

    }

}
