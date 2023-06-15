<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class TipoContribuyente extends Model
{
    use LogsActivity;

    protected $table = 'tipoContribuyente';
    protected $fillable = ['tpc_nombre'];
    protected $guarded = 'tpc_id';
    protected $primaryKey = 'tpc_id';
    protected static $logName = 'tipoContribuyente';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public static function getTiposContribuyente()
    {
        $tipos = new TipoContribuyente();
        return $tipos->orderBy('tpc_id')->get();
    }
}
