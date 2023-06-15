<?php

namespace App\Models\Cxc;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class DetalleRetencion extends Model
{
    use LogsActivity;

    protected $table = 'detalleretencion';
    protected $fillable = ['detr_doc','detr_factura',
    'detr_retencion','detr_tiporetencion'];
    protected $guarded = 'detr_id';
    protected $primaryKey = 'detr_id';
    protected static $logName = 'detalleretencion';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function Factura(){
        return $this->belongsTo('App\Models\Cxc\Facturacion','detr_factura','ven_id');
    }

    public function Retencion()
    {
        return $this->belongsTo('App\Models\Cxc\TipoRetencion', 'detr_tiporetencion', 'tret_id');
    }


}
