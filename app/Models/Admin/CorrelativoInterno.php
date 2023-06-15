<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class CorrelativoInterno extends Model
{
    protected $table = 'CorrelativoInt';
    protected $fillable = ['corr_empresa','corr_terminal','corr_tipo','corr_mes','corr_anio','corr_especifico','corr_general','corr_correlativo'];
    protected $guarded = 'corr_id';
    protected $primaryKey = 'corr_id';


    
    public function Empresa()
    {
        return $this->belongsTo('App\Models\Parametros\Empresa', 'corr_empresa', 'emp_id');

    }


    public function getCorrelativo($empid){
        $correlativo = new CorrelativoInterno();
        return $correlativo->where('corr_id',$empid)->first()->corr_correlativo;
    }

    public function getCorrelativo1($empid){
        $correlativo = new CorrelativoInterno();
        return $correlativo->where('corr_id',$empid)->first()->corr_especifico;
    }


    public function Correlativo(){
        return $this->belongsTo('App\Models\Admin\CorrelativoInterno','ven_correlativoInt','corr_id');
    }
}
