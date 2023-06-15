<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Certificador extends Model
{
    use LogsActivity;

    protected $table = 'certificador';
    protected $fillable = ['cer_nombre','cer_direccion','cer_telefono','cer_contacto'];
    protected $guarded = 'cer_id';
    protected $primaryKey = 'cer_id';
    protected static $logName = 'certificador';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;


    public static function getCertificadores()
    {
        $certificador = new Certificador();
       return $certificador->orderBy('cer_id')->get();
    }
}
