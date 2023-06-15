<?php

namespace App\Models\Planilla;

use Illuminate\Database\Eloquent\Model;

class DetalleTurnos extends Model
{
    protected $table = 'detalleturnos';
    protected $fillable = ['dett_reporte', 'dett_empleado','dett_turnos','dett_extras','dett_ordinales'];
    protected $guarded = 'dett_id';
    protected $primaryKey = 'dett_id';
    protected static $logName = 'detalleturnos';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;


    public function ReporteTurnos()
    {
        return $this->belongsTo('App\Models\Planilla\ReporteTurnos', 'dett_reporte','rept_id');
    }
}
