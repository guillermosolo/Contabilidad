<?php

namespace App\Models\cyb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class DetalleConciliacion extends Model
{
    use LogsActivity;

    protected $table = 'detalleconciliacion';
    protected $fillable = ['dcon_conciliacion', 'dcon_documento','dcon_conciliado'];
    protected $guarded = 'dcon_linea';
    protected $primaryKey = 'dcon_linea';
    protected static $logName = 'detalleconciliacion';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;


    public static function totalConciliacion($id)
    {

        return DB::table('detalleconciliacion as d')
            ->join('transaccionbancaria as t', 't.trab_id', '=', 'd.dcon_documento')
            ->where('dcon_conciliacion', '=', $id)
            ->where('trab_conciliado', '=', true)->sum('t.trab_monto');

    }
    public function Transaccion()
    {
        return $this->belongsTo('App\Models\cyb\Transacciones', 'dcon_documento', 'trab_id');

    }

}
