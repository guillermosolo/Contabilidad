<?php

namespace App\Models\Planilla;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ReporteHoraExtra extends Model
{
    use LogsActivity;

    protected $table = 'reportehorae';
    protected $fillable = ['ree_fecha', 'ree_horas', 'ree_tipo', 'ree_empleado'];
    protected $guarded = 'ree_id';
    protected $primaryKey = 'ree_id';
    protected static $logName = 'reportehorae';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;


    public function Empleado()
    {
        return $this->belongsTo('App\Models\Planilla\Empleado', 'ree_empleado','empl_id');
    }
}
