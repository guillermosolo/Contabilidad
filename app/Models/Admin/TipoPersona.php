<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class TipoPersona extends Model
{
    use LogsActivity;

    protected $table = 'tipopersona';
    protected $fillable = ['tpp_nombre','tpp_nickname', 'tpp_clasificacion'];
    protected $guarded = 'tpp_id';
    protected $primaryKey = 'tpp_id';
    protected static $logName = 'tipoPersona';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public static function getTiposProveedor()
    {
        $tipos = new TipoPersona();
        return $tipos->where('tpp_clasificacion','P')->orderBy('tpp_id')->get();
    }

    public static function getTiposClientes()
    {
        $tipos = new TipoPersona();
        return $tipos->where('tpp_clasificacion','C')->orderBy('tpp_id')->get();
    }


}
