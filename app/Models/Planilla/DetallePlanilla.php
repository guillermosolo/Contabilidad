<?php

namespace App\Models\Planilla;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class DetallePlanilla extends Model
{
    use LogsActivity;

    protected $table = 'detalleplanilla';
    protected $fillable = ['detp_planilla', 'dept_empleado', 'dept_tipo', 'dept_monto'];
    protected $guarded = 'detp_id';
    protected $primaryKey = 'detp_id';
    protected static $logName = 'detalleplanilla';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;


    public function Planilla()
    {
        return $this->belongsTo('App\Models\Planilla\Planilla', 'detp_planilla','pla_id');
    }

    public function Empleado()
    {
        return $this->belongsTo('App\Models\Planilla\Empleado', 'dept_empleado','empl_id');
    }
}
