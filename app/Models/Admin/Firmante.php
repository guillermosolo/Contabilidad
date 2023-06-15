<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Firmante extends Model
{
    use LogsActivity;

    protected $table = 'firmante';
    protected $fillable = ['fir_nombre'];
    protected $guarded = 'fir_id';
    protected $primaryKey = 'fir_id';
    protected static $logName = 'firmante';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;
}
