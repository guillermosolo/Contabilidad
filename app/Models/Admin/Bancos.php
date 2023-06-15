<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Bancos extends Model
{
    use LogsActivity;

    protected $table = 'bancos';
    protected $fillable = ['ban_id','ban_nombre', 'ban_siglas'];
    protected $guarded = 'ban_id';
    protected $primaryKey = 'ban_id';
    protected static $logName = 'bancos';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;
}
