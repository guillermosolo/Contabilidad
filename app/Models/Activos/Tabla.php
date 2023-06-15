<?php

namespace App\Models\Activos;

use Illuminate\Database\Eloquent\Model;

class Tabla extends Model
{
    protected $table = 'tabla';
    protected $fillable = ['tab_activo','tab_mes','tab_anio','tab_monto','tab_tipo'];
    protected $guarded = 'tab_id';
    protected $primaryKey = 'tab_id';
    protected static $logName = 'tablaDep';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;
}
