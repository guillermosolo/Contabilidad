<?php

namespace App\Models\cxp;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Proveedor extends Model
{
    use LogsActivity;

    protected $table = 'proveedores';
    protected $fillable = ['pro_persona', 'pro_tipoProveedor', 'pro_credito'];
    protected $guarded = 'pro_id';
    protected $primaryKey = 'pro_id';
    protected static $logName = 'proveedor';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function Persona()
    {
        return $this->belongsTo('App\Models\Admin\Persona', 'pro_persona', 'per_id');
    }

    public function TipoProveedor()
    {
        return $this->belongsTo('App\Models\Admin\TipoPersona', 'pro_tipoProveedor', 'tpp_id');
    }

    public function getProveedores()
    {
        $proveedores = new Proveedor();
        return $proveedores->get();
    }
}
