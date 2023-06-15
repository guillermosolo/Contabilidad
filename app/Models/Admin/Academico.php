<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Academico extends Model
{
    use LogsActivity;

    protected $table = 'academico';
    protected $fillable = ['aca_id','aca_descripcion'];
    protected $guarded = 'aca_id';
    protected $primaryKey = 'aca_id';
    protected static $logName = 'academico';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;


    public static function getAcademicos()
    {
        $academico = new Academico();
        return $academico->orderBy('aca_id')->get();
    }
}
