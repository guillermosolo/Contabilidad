<?php

use Carbon\Carbon;
use App\Models\Parametros\Terminal;
use App\Models\Admin\CorrelativoInterno;

if (!function_exists('getCorrelativo')) {
    function getCorrelativo($fecha, $empresa, $terminal, $tipo)
    {
        $correlativo = CorrelativoInterno::all();
        $Corr = new CorrelativoInterno;
        $Corr->corr_empresa = $empresa;
        if ($terminal == "XX") {
            $Corr->corr_terminal = 0;
            $term = "XX";
        } else {
            $Corr->corr_terminal = $terminal;
            $term =  Terminal::findOrFail($terminal)->ter_abreviatura;
        }
        $Corr->corr_tipo = $tipo;
        $fecha = Carbon::now();
        $Corr->corr_mes = $fecha->format('m');
        $Corr->corr_anio = $fecha->format('y');
        $emp = str_pad($empresa, 2, '0', STR_PAD_LEFT);
        $mes = str_pad($Corr->corr_mes, 2, '0', STR_PAD_LEFT);
        $anio = $Corr->corr_anio;
        $ultimoE = $correlativo->where('corr_empresa', $empresa)->where('corr_tipo', $tipo)->where('corr_anio', $fecha->format('y'))->last();
        if (is_null($ultimoE)) {
            $Corr->corr_especifico = 1;
        } else {
            $Corr->corr_especifico = $ultimoE->corr_especifico + 1;
        }
        $ultimoG = $correlativo->where('corr_empresa', $empresa)->where('corr_anio', $fecha->format('y'))->last();
        if (is_null($ultimoG)) {
            $Corr->corr_general = 1;
        } else {
            $Corr->corr_general = $ultimoG->corr_general + 1;
        }
        $especifico = str_pad($Corr->corr_especifico, 5, '0', STR_PAD_LEFT);
        $general = str_pad($Corr->corr_general, 5, '0', STR_PAD_LEFT);
        $Corr->corr_correlativo = $emp . "-" . $term . "-" . $tipo . "-" . $mes . "-" . $anio . "-" . $especifico . "-" . $general;
        $Corr->save();
        return $Corr;
    }
}
