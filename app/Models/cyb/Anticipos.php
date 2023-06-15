<?php

namespace App\Models\cyb;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Anticipos extends Model
{
    use LogsActivity;

    protected $table = 'anticipo';
    protected $fillable = ['ant_id','ant_numero','ant_fecha','ant_liquidado','ant_cheque','ant_proveedor', 'ant_estado'];
    protected $guarded = 'ant_id';
    protected $primaryKey = 'ant_id';
    protected static $logName = 'anticipo';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function CuentaAnticipo()
    {
        return $this->belongsTo('App\Models\cyb\CuentasBancarias', 'ant_numero', 'ctab_id');

    }

    public function ChequeAnticipo()
    {
        return $this->belongsTo('App\Models\cyb\Cheque', 'ant_cheque', 'che_id');

    }

    public function ProveedorAnticipo()
    {
        return $this->belongsTo('App\Models\cxp\Proveedor', 'ant_proveedor', 'pro_id');
    }
}
