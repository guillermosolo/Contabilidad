<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class TiposRepresentante extends Model
{
    use LogsActivity;

    protected $table = 'tiporepresentante';
    protected $fillable = ['trep_nombre'];
    protected $guarded = 'trep_id';
    protected $primaryKey = 'trep_id';
    protected static $logName = 'tipoRepresentante';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public static function getTipo($param)
    {
        $tipo = new TiposRepresentante();
        return $tipo->where('trep_id',$param)->first()->trep_nombre;
    }

    public static function getTipos()
    {
        $tipos = new TiposRepresentante();
        return $tipos->orderBy('trep_id')->get();
    }
}
