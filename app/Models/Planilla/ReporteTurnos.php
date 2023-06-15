<?php

namespace App\Models\Planilla;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ReporteTurnos extends Model
{
    use LogsActivity;

    protected $table = 'reporteturnos';
    protected $fillable = ['rept_fecha', 'rept_nombreBuque', 'rept_turno', 'rept_bodegas', 'rept_inicio', 'rept_fin', 'rept_produccion','rept_planilla'];
    protected $guarded = 'rept_id';
    protected $primaryKey = 'rept_id';
    protected static $logName = 'reporteturnos';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;


    public function Planilla()
    {
        return $this->belongsTo('App\Models\Planilla\Planilla', 'rept_planilla','pla_id');
    }
}
