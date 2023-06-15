<?php

namespace App\Models\Cxc;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class TipoRetencion extends Model
{
    use LogsActivity;

    protected $table = 'tiporetencion';
    protected $fillable = ['tret_descripcion'];
    protected $guarded = 'tret_id';
    protected $primaryKey = 'tret_id';
    protected static $logName = 'tiporetencion';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public static function getTipoRetencion()
    {
        $moneda = new TipoRetencion();
        return $moneda->where('tret_id', '>', '0')->orderBy('tret_id')->get();
    }

    



}



