<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Symfony\Component\HttpFoundation\Request;

class CuentaContable extends Model
{
    use LogsActivity;

    protected $table = 'cuentacontable';
    protected $fillable = ['cta_codigo', 'cta_descripcion', 'cta_padre', 'cta_detalle', 'cta_centrocosto', 'cta_tiposaldo','cta_excento','cta_obs1','cta_obs2','cta_obs3', 'cta_empresa'];
    protected $guarded = 'cta_id';
    protected $primaryKey = 'cta_id';
    protected static $logName = 'cuentacontable';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;


    public static function getDetalles($emp, $cuenta = false,$excento = false)
    {
        if (!$cuenta) {
            $detalle=CuentaContable::where([['cta_detalle', '1'], ['cta_empresa', $emp]])->orderBy('cta_id')->get();
        } else {
            $detalle=CuentaContable::where([['cta_detalle', '1'], ['cta_empresa', $emp], ['cta_codigo', 'LIKE', $cuenta]])->orderBy('cta_id')->get();
        }
        return $detalle;
    }
    public static function getPadre($emp,$codigo)
{
    $padre = CuentaContable::where([['cta_empresa',$emp],['cta_codigo',$codigo]])->first();
    return $padre;
}
    public function Empresa()
    {
        return $this->belongsTo('App\Models\Parametros\Empresa', 'cta_empresa', 'emp_id');
    }

}
