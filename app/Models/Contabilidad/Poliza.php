<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class Poliza extends Model
{
    protected $table = 'polizas';
    protected $fillable = ['pol_fecha','pol_descripcion','pol_empresa'];
    protected $guarded = 'pol_id';
    protected $primaryKey = 'pol_id';
    protected static $logName = 'polizas';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;
}
