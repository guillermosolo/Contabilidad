<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Regimen extends Model
{
    use LogsActivity;

    protected $table = 'regimen';
    protected $fillable = ['reg_descripcion', 'reg_desc_ct'];
    protected $guarded = 'reg_id';
    protected $primaryKey = 'reg_id';
    protected static $logName = 'regimen';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public static function getRegimenes()
    {
        $regimen = new Regimen();
       return $regimen->orderBy('reg_id')->get();
    }
}
