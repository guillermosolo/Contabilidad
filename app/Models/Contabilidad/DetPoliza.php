<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class DetPoliza extends Model
{
    protected $table = 'detpolizas';
    protected $fillable = ['dpol_idpoliza','dpol_ctaContable','dpol_monto','dpol_posicion'];
    protected $guarded = 'dpol_id';
    protected $primaryKey = 'dpol_id';
    protected static $logName = 'detpolizas';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

}
