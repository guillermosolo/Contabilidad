<?php

namespace App\Models\Planilla;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class DescBon extends Model
{
    use LogsActivity;

    protected $table = 'descbon';
    protected $fillable = ['desc_tipo', 'desc_monto', 'desc_inicio', 'desc_fin', 'desc_cuentaContable','desc_general'];
    protected $guarded = 'desc_id';
    protected $primaryKey = 'desc_id';
    protected static $logName = 'descbon';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function TiposDesc()
    {
        return $this->belongsTo('App\Models\Planilla\TiposDesc', 'desc_tipo','tipd_id');
    }

    public function CuentaContable()
    {
        return $this->belongsTo('App\Models\Contabilidad\CuentaContable', 'desc_cuentaContable','cta_id');
    }

}
