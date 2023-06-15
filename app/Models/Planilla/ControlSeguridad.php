<?php

namespace App\Models\Planilla;

use Illuminate\Database\Eloquent\Model;

class ControlSeguridad extends Model
{
    protected $table = 'controlseguridad';
    protected $fillable = ['cons_fecha', 'cons_empleado', 'cons_ingreso', 'cons_salida'];
    protected $guarded = 'cons_id';
    protected $primaryKey = 'cons_id';
    protected static $logName = 'controlseguridad';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;
}
