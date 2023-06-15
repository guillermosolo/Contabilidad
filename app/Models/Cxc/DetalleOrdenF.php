<?php

namespace App\Models\Cxc;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class DetalleOrdenF extends Model
{
    use LogsActivity;

    protected $table = 'detalleordenf';
    protected $fillable = ['dof_ordenF','dof_producto', 'dof_tarifa','dof_cantidad'];
    protected $guarded = 'dof_id';
    protected $primaryKey = 'dof_id';
    protected static $logName = 'detalleordenf';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;



    public function Productos(){
        return $this->belongsTo('App\Models\Cxc\Productos','dof_producto','prod_id');
    }

}
