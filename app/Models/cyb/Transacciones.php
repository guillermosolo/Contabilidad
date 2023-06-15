<?php

namespace App\Models\cyb;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Transacciones extends Model
{
    use LogsActivity;

    protected $table = 'transaccionbancaria';
    protected $fillable = ['trab_id','trab_cuentabancaria','trab_fecha','trab_documento','trab_tipo','trab_descripcion','trab_monto','trab_conciliado','trab_correlativoInt'];
    protected $guarded = 'trab_id';
    protected $primaryKey = 'trab_id';
    protected static $logName = 'transaccionbancaria';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;


    public function CuentadeBanco()
    {
        return $this->belongsTo('App\Models\cyb\CuentasBancarias', 'trab_cuentabancaria', 'ctab_id');
    }
}
