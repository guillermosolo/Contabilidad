<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Idioma extends Model
{
    use LogsActivity;

    protected $table = 'idiomas';
    protected $fillable = ['idi_id','idi_descripcion'];
    protected $guarded = 'idi_id';
    protected $primaryKey = 'idi_id';
    protected static $logName = 'idiomas';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;


    public static function getIdiomas()
    {
        $idioma = new Idioma();
        return $idioma->orderBy('idi_id')->get();
    }
}
