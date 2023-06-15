<?php

namespace App\Models\Cxc;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class Retenciones extends Model
{
    use LogsActivity;

    protected $table = 'documentosvarios';
    protected $fillable = ['docv_fecha','docv_formularioSAT','docv_numero','docv_persona','docv_monto','docv_empresa',
                            'docv_terminal','docv_correlativoInt','docv_tipo'];
    protected $guarded = 'docv_id';
    protected $primaryKey = 'docv_id';
    protected static $logName = 'documentosvarios';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function Terminal()
    {
        return $this->belongsTo('App\Models\Parametros\Terminal','docv_terminal', 'ter_id');
    }

    public function Empresa()
    {
        return $this->belongsTo('App\Models\Parametros\Empresa', 'docv_empresa', 'emp_id');
    }


    public function Cliente()
    {
        return $this->belongsTo('App\Models\Admin\Persona', 'docv_persona', 'per_id');
    }



    public function Correlativo(){
        return $this->belongsTo('App\Models\Admin\CorrelativoInterno','docv_correlativoInt','corr_id');
    }

    public function detalleRetencion(){
        return $this->hasMany('App\Models\Cxc\DetalleRetencion','detr_doc','docv_id');
    }


    public function Retencion()
    {
        return $this->belongsTo('App\Models\Cxc\TipoRetencion', 'tret_descripcion', 'docv_id');
    }


}



