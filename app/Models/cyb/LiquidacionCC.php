<?php

namespace App\Models\cyb;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class LiquidacionCC extends Model
{
    use LogsActivity;

    protected $table = 'liquidacioncc';
    protected $fillable = ['lcc_id', 'lcc_descripcion', 'lcc_fecha', 'lcc_cajachica', 'lcc_pendiente'];
    protected $guarded = 'lcc_id';
    protected $primaryKey = 'lcc_id';
    protected static $logName = 'liquidacioncc';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function Cajas()
    {
        return $this->belongsTo('App\Models\cyb\CajaChica', 'lcc_cajachica', 'cch_id');

    }

    public function NEmpresa()
    {
        return $this->belongsTo('App\Models\Parametros\Empresa', 'lcc_cajachica', 'cch_id');

    }
}


