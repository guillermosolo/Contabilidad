<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class TipoCompra extends Model
{
    use LogsActivity;

    protected $table = 'tipocompra';
    protected $fillable = ['tipc_descripcion'];
    protected $guarded = 'tipc_id';
    protected $primaryKey = 'tipc_id';
    protected static $logName = 'tipoCompra';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public static function getTipoCompra()
    {
        $tiposCompra = new TipoCompra();
        return $tiposCompra->orderBy('tipc_id')->get();
    }
}
