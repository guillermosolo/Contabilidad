<?php

namespace App\Models\cxp;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Importacion extends Model
{
    use LogsActivity;

    protected $table = 'polizasimportacion';
    protected $fillable = ['poim_fecha','poim_proveedor','poim_descripcion','poim_orden','poim_dua','poim_moneda','poim_tipoCambio','poim_FOB','poim_flete','poim_seguro','poim_IVA','poim_empresa','poim_terminal','poim_correlativoInt'];
    protected $guarded = 'poim_id';
    protected $primaryKey = 'poim_id';
    protected static $logName = 'PolizasImportacion';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function Moneda(){
        return $this->belongsTo('App\Models\Admin\Moneda', 'poim_moneda', 'mon_id');
    }

    public function Empresa(){
        return $this->belongsTo('App\Models\Parametros\Empresa','poim_empresa','emp_id');
    }

    public function Terminal(){
        return $this->belongsTo('App\Models\Parametros\Terminal','poim_terminal','ter_id');
    }

    public function Correlativo(){
        return $this->belongsTo('App\Models\Admin\CorrelativoInterno','poim_correlativoInt','corr_id');
    }

    public function detallePoliza(){
        return $this->hasMany('App\Models\cxp\DetallePoliza','detp_poliza','poim_id');
    }
}
