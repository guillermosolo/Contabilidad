<?php

namespace App\Models\Cxc;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class DetalleVentas extends Model
{
    use LogsActivity;

    protected $table = 'detalleventas';
    protected $fillable = ['detv_venta', 'detv_producto','detv_precioU','detv_cantidad',
    'detv_descuento'];
    protected $guarded = 'detv_id';
    protected $primaryKey = 'detv_id';
    protected static $logName = 'detalleventas';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;


    public function Productos(){
        return $this->belongsTo('App\Models\Cxc\Productos','detv_producto','prod_id');
    }
}
