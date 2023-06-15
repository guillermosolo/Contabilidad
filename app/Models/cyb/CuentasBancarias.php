<?php

namespace App\Models\cyb;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class CuentasBancarias extends Model
{
    use LogsActivity;

    protected $table = 'cuentabancaria';
    protected $fillable = ['ctab_id', 'ctab_numero', 'ctab_tipo', 'ctab_banco', 'ctab_moneda', 'ctab_cuentacontable', 'ctab_empresa', 'ctab_contacto', 'ctab_telefono'];
    protected $guarded = 'ctab_id';
    protected $primaryKey = 'ctab_id';
    protected static $logName = 'cuentabancaria';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;


    public function Tipo()
    {
        return $this->belongsTo('App\Models\cyb\TipoCuenta', 'ctab_tipo', 'tcb_id');
    }

    public function Banco()
    {
        return $this->belongsTo('App\Models\Admin\Bancos', 'ctab_banco', 'ban_id');
    }

    public function Moneda()
    {
        return $this->belongsTo('App\Models\Admin\Moneda', 'ctab_moneda', 'mon_id');
    }

    public function Contable()
    {
        return $this->belongsTo('App\Models\Contabilidad\CuentaContable', 'ctab_cuentacontable', 'cta_id');
    }

    public function Empresa()
    {
        return $this->belongsTo('App\Models\Parametros\Empresa', 'ctab_empresa', 'emp_id');
    }



}
