<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Discapacidad extends Model
{
    use LogsActivity;

    protected $table = 'discapacidad';
    protected $fillable = ['dis_id','dis_descripcion'];
    protected $guarded = 'dis_id';
    protected $primaryKey = 'dis_id';
    protected static $logName = 'discapacidad';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public static function getDiscapacidades()
    {
        $despacidad = new Discapacidad();
        return $despacidad->orderBy('dis_id')->get();
    }
}
