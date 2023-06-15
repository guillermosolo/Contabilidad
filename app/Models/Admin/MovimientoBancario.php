<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class MovimientoBancario extends Model
{
    use LogsActivity;

    protected $table = 'movimientobancario';
    protected $fillable = ['movb_descripcion', 'movb_cuentacontable'];
    protected $guarded = 'movb_id';
    protected $primaryKey = 'movb_id';
    protected static $logName = 'movimientoBancario';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function CuentaContable()
  {
    return $this->belongsTo('App\Models\Contabilidad\CuentaContable', 'movb_cuentacontable', 'cta_id');
  }
}
