<?php

namespace App\Models\cyb;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Conciliaciones extends Model
{
    use LogsActivity;

    protected $table = 'conciliacion';
    protected $fillable = ['con_anio','con_mes','con_saldo','con_conciliado','con_cuentabancaria'];
    protected $guarded = 'con_id';
    protected $primaryKey = 'con_id';
    protected static $logName = 'conciliacion';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function ConciliacionCuenta()
    {
        return $this->belongsTo('App\Models\cyb\CuentasBancarias', 'con_cuentabancaria', 'ctab_id');

    }
}
