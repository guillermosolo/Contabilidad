<?php

namespace App\Models\Cxc;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Ncredito extends Model
{
    use LogsActivity;

    protected $table = 'ventas';
    protected $fillable = ['ven_fecha','ven_persona','ven_tipo','ven_moneda','ven_tipoCambio',
    'ven_descripcion','ven_total','ven_iiud','ven_numDoc','ven_serie','ven_fechaCert',
    'ven_empresa','ven_terminal','ven_correlativoInt'];
    protected $guarded = 'ven_id';
    protected $primaryKey = 'ven_id';
    protected static $logName = 'ventas';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;
    public function Terminal()
    {
        return $this->belongsTo('App\Models\Parametros\Terminal','ven_terminal', 'ter_id');
    }

    public function Empresa()
    {
        return $this->belongsTo('App\Models\Parametros\Empresa', 'ven_empresa', 'emp_id');
    }


    public function Cliente()
    {
        return $this->belongsTo('App\Models\Admin\Persona', 'ven_persona', 'per_id');
    }


    public function DetalleVentas()
    {
        return $this->hasMany('App\Models\Cxc\DetalleVentas', 'detv_venta', 'ven_id');
    }


    public function Correlativo(){
        return $this->belongsTo('App\Models\Admin\CorrelativoInterno','ven_correlativoInt','corr_id');
    }

    public function Moneda()
    {
        return $this->belongsTo('App\Models\Admin\Moneda', 'ven_moneda', 'mon_id');
    }


    public function Factura(){
        return $this->belongsTo('App\Models\Cxc\Facturacion', 'ven_tipo', 'ven_id');

    }


}
