<?php

namespace App\Models\Activos;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class CuentasAmortizacion extends Model
{
    use LogsActivity;

    protected $table = 'cuentasamortizacion';
    protected $fillable = ['cam_fecha','cam_cuenta','cam_categoria','cam_amort','cam_amortAcum','cam_monto','cam_inical','cam_porcentaje','cam_descripcion', 'cam_empresa', 'cam_terminal'];
    protected $guarded = 'cam_id';
    protected $primaryKey = 'cam_id';
    protected static $logName = 'Amortizaciones';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function Terminal()
    {
        return $this->belongsTo('App\Models\Parametros\Terminal','cam_terminal', 'ter_id');
    }

    public function Empresa()
    {
        return $this->belongsTo('App\Models\Parametros\Empresa', 'cam_empresa', 'emp_id');
    }
}
