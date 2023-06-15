<?php

namespace App\Models\cyb;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class TipoCuenta extends Model
{
    use LogsActivity;

    protected $table = 'tipocuentabancaria';
    protected $fillable = ['tcb_id','tcb_descripcion'];
    protected $guarded = 'tcb_id';
    protected $primaryKey = 'tcb_id';
    protected static $logName = 'tipocuentabancaria';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;
}
