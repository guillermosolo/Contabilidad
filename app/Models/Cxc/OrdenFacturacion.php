<?php

namespace App\Models\Cxc;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class OrdenFacturacion extends Model
{

    use LogsActivity;

    protected $table = 'ordenfacturacion';
    protected $fillable = ['ordf_eta', 'ordf_buque','ordf_total','ordf_viaje','ordf_cliente',
    'ordf_moneda','ordf_contenedores','ordf_tipoCambio','ordf_factura','ordf_empresa','ordf_terminal','ordf_correlativoInt'
    ,'ordf_descripcion','ordf_anulada'];
    protected $guarded = 'ordf_id';
    protected $primaryKey = 'ordf_id';
    protected static $logName = 'ordenfacturacion';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;



    public function Terminal()
    {
        return $this->belongsTo('App\Models\Parametros\Terminal','ordf_terminal', 'ter_id');
    }

    public function Empresa()
    {
        return $this->belongsTo('App\Models\Parametros\Empresa', 'ordf_empresa', 'emp_id');
    }

    public function Cliente()
    {
        return $this->belongsTo('App\Models\Admin\Persona', 'ordf_cliente', 'per_id');
    }

    public function Moneda()
    {
        return $this->belongsTo('App\Models\Admin\Moneda', 'ordf_moneda', 'mon_id');
    }

    public function Correlativo(){
        return $this->belongsTo('App\Models\Admin\CorrelativoInterno','ordf_correlativoInt','corr_id');
    }

    public function detalleOrdenFacturacion(){
        return $this->hasMany('App\Models\Cxc\DetalleOrdenF','dof_ordenF','ordf_id');
    }




}



