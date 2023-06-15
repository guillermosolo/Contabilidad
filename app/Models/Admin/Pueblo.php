<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Pueblo extends Model
{
    use LogsActivity;

    protected $table = 'pueblo';
    protected $fillable = ['pue_id','pue_descripcion'];
    protected $guarded = 'pue_id';
    protected $primaryKey = 'pue_id';
    protected static $logName = 'pueblo';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;


    public static function getPueblos()
    {
        $pueblo = new Pueblo();
        return $pueblo->orderBy('pue_id')->get();
    }
}
