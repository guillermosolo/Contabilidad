<?php

namespace App\Models\Cxc;

use Illuminate\Database\Eloquent\Model;
use App\Models\Contabilidad\CuentaContable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Http\Request;

class Productos extends Model
{
    use LogsActivity;

    protected $table = 'productos';
    protected $fillable = ['prod_desc_lg','prod_desc_ct','prod_padre','prod_cuentacontable',
    'prod_empresa','prod_terminal','prod_codigo'];
    protected $guarded = 'prod_id';
    protected $primaryKey = 'prod_id';
    protected static $logName = 'productos';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;


    public function Terminal()
    {
        return $this->belongsTo('App\Models\Parametros\Terminal','prod_terminal', 'ter_id');
    }

    public function Empresa()
    {
        return $this->belongsTo('App\Models\Parametros\Empresa', 'prod_empresa', 'emp_id');
    }

    public function Productos()
    {
        return $this->belongsTo('App\Models\Contabilidad\CuentaContable', 'prod_cuentacontable', 'cta_id');
    }


    public function DetalleOrdenFacturacion(){
        return $this->hasMany('App\Models\Cxc\DetalleOrdenF','dof_producto','dof_id');
    }

    public function DetalleVentas(){
        return $this->hasMany('App\Models\Cxc\DetalleVentas','detv_producto','detv_id');
    }

    public function getProducto($perid){
        $producto = new Productos();
        return $producto->where('prod_id',$perid)->first()->prod_desc_lg;
    }











   }

