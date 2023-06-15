<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Paises extends Model
{
    use LogsActivity;

    protected $table = 'paises';
    protected $fillable = ['pai_id', 'pai_descripcion'];
    protected $guarded = 'pai_id';
    protected $primaryKey = 'pai_id';
    protected static $logName = 'paises';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public static function getPaises()
    {
        $pais = new Paises();
        return $pais->orderBy('pai_id')->get();
    }
}
