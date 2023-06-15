<?php

namespace App\Models\Cxc;

use Illuminate\Database\Eloquent\Model;
use App\Models\Contabilidad\CuentaContable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Http\Request;

class Abonos extends Model
{
    use LogsActivity;

    protected $table = 'abonos';
    protected $fillable = ['abf_documento','abf_monto','abf_tipoAbono','abf_referencia','abf_fecha'];
    protected $guarded = 'abf_id';
    protected $primaryKey = 'abf_id';
    protected static $logName = 'abonos';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;


    
    





   }

