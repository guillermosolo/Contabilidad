<?php

namespace App\Models\cxp;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Compras extends Model
{
    use LogsActivity;

    protected $table = 'compras';
    protected $fillable = ['com_fecha','com_persona','com_numDoc','com_serie','com_descripcion','com_monto','com_tipo','com_retencion','com_peqcontribuyente','com_mesReportar','com_excento','com_ctaExcento','com_anulada','com_empresa','com_terminal','com_correlativoInt'];
    protected $guarded = 'com_id';
    protected $primaryKey = 'com_id';
    protected static $logName = 'compras';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function TipoCompra(){
        return $this->belongsTo('App\Models\Admin\TipoCompra','com_tipo','tipc_id');
    }

    public function Persona(){
        return $this->belongsTo('App\Models\Admin\Persona','com_persona','per_id');
    }

    public function Activo(){
        return $this->belongsToMany('App\Models\Activos\Activos','activofactura','af_documento','af_activo')->withTimestamps()->withPivot('af_tipoDoc');
    }

    public function Empresa(){
        return $this->belongsTo('App\Models\Parametros\Empresa','com_empresa','emp_id');
    }

    public function Terminal(){
        return $this->belongsTo('App\Models\Parametros\Terminal','com_terminal','ter_id');
    }

    public function Correlativo(){
        return $this->belongsTo('App\Models\Admin\CorrelativoInterno','com_correlativoInt','corr_id');
    }

    public function detalleCompras(){
        return $this->hasMany('App\Models\cxp\DetalleCompras','detc_documento','com_id');
    }

}
