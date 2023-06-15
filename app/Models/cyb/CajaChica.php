<?php

namespace App\Models\cyb;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class CajaChica extends Model
{
    use LogsActivity;

    protected $table = 'cajachica';
    protected $fillable = ['cch_id','cch_nombre','cch_responsable','cch_cuentacontable','cch_empresa','cch_monto'];
    protected $guarded = 'cch_id';
    protected $primaryKey = 'cch_id';
    protected static $logName = 'cajachica';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;


    public function Responsable()
    {
        return $this->belongsTo('App\Models\Planilla\Empleado', 'cch_responsable', 'empl_id');

    }

    public function CuentaContable()
    {
        return $this->belongsTo('App\Models\Contabilidad\CuentaContable', 'cch_cuentacontable', 'cta_id');
    }

    public function Empresa()
    {
        return $this->belongsTo('App\Models\Parametros\Empresa', 'cch_empresa', 'emp_id');
    }


}
