<?php

namespace App\Models\Cxc;


use App\Models\Admin\DepMun;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Invoice extends Model
{

    use LogsActivity;

    protected $table = 'ventas';
    protected $fillable = ['ven_fecha','ven_persona','ven_tipo','ven_moneda','ven_tipoCambio',
    'ven_descripcion','ven_total','ven_iiud','ven_numDoc','ven_serie','ven_fechaCert',
    'ven_empresa','ven_terminal','ven_correlativoInt','ven_enlacefactura','ven_referecnia','ven_iva','ven_siniva'];
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

    public function Detalle()
    {
        return $this->hasMany('App\Models\Cxc\DetalleVentas', 'detv_venta', 'ven_id');
    }

    public function detalleOrdenFacturacion(){
        return $this->hasMany('App\Models\Cxc\DetalleOrdenF','dof_ordenF','ordf_id');
    }

    public function Correlativo(){
        return $this->belongsTo('App\Models\Admin\CorrelativoInterno','ven_correlativoInt','corr_id');
    }

    public function Moneda()
    {
        return $this->belongsTo('App\Models\Admin\Moneda', 'ven_moneda', 'mon_id');
    }

    public function Productos(){
        return $this->belongsTo('App\Models\Cxc\Productos','prod_desc_lg','prod_id');
    }

    public function DetalleVentas()
    {
        return $this->hasMany('App\Models\Cxc\DetalleVentas', 'detv_venta', 'ven_id');
    }

    public function Departamento()
    {
        return $this->belongsTo('App\Models\Admin\DepMun', 'emp_municipio', 'dep_id');
    }
    public static function getDescLg($municipio)
    {
        $municipios = new DepMun();
        $descLg =$municipios->getMun($municipio) . ', ' . $municipios->getDepto($municipio);
        return $descLg;
    }

    public function Detalles(){
        return $this->hasMany('App\Models\Cxc\DetalleVentas','detv_venta','ven_id');
    }




    public static function getFactura()
  {
      $factura = new Facturacion();
      return $factura->where('ven_tipo', 'LIKE', 'F')->orderBy('ven_id')->get();
  }


  public static function getFacturas($emp)
    {
        $detalle = new Facturacion();

            return $detalle->where([['ven_empresa', $emp],['ven_tipo', 'LIKE','F']])->orderBy('ven_id')->get();

    }












}
