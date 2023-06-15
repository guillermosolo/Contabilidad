<?php

namespace App\Models\Planilla;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ReporteAusencia extends Model
{
    use LogsActivity;
    protected $table = 'reporteausencia';
    protected $fillable = ['rea_empleado', 'rea_inicio', 'rea_fin', 'rea_observaciones'];
    protected $guarded = 'rea_id';
    protected $primaryKey = 'rea_id';
    protected static $logName = 'reporteausencia';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;


    public function Empleado()
    {
        return $this->belongsTo('App\Models\Planilla\Empleado', 'rea_empleado','empl_id');
    }
}
