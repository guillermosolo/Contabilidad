<?php

namespace App\Models\Planilla;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ReporteTurnosBarcos extends Model
{
    use LogsActivity;

    protected $table = 'reporteturnosbarcos';
    protected $fillable = ['retb_inicio', 'retb_fin', 'retb_turnos', 'retb_extras', 'retb_ordinales', 'retb_planilla', 'retb_empleado'];
    protected $guarded = 'retb_id';
    protected $primaryKey = 'retb_id';
    protected static $logName = 'reporteturnosbarcos';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function Planilla()
    {
        return $this->belongsTo('App\Models\Planilla\Planilla', 'retb_planilla', 'pla_id');
    }

    public function Empleado()
    {
        return $this->belongsTo('App\Models\Planilla\Empleado', 'retb_empleado', 'empl_id');
    }
}
