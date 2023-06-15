<?php

namespace App\Models\Planilla;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class TiposDesc extends Model
{
    use LogsActivity;

    protected $table = 'tipodesc';
    protected $fillable = ['tipd_descripcion', 'tipd_forma', 'tipd_clase'];
    protected $guarded = 'tipd_id';
    protected $primaryKey = 'tipd_id';
    protected static $logName = 'tipodesc';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;


    public function getTipo($param){
        $tipoDesc = new TiposDesc();
        return $tipoDesc->orderBy('tipd_id')->where('tipd_clase',$param)->get();
    }

}
