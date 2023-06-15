<?php

namespace App\Models\cyb;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{
    use LogsActivity;

    protected $table = 'cheque';
    protected $fillable = ['che_id', 'che_cuentabancaria', 'che_numero', 'che_fecha', 'che_monto', 'che_beneficiario', 'che_descripcion', 'che_negociable', 'che_tipo',
        'che_tc', 'che_correlativoInt'];
    protected $guarded = 'che_id';
    protected $primaryKey = 'che_id';
    protected static $logName = 'cheque';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function CuentasBancarias()
    {
        return $this->belongsTo('App\Models\cyb\CuentasBancarias', 'che_cuentabancaria', 'ctab_id');
    }

}



