<?php

namespace App\Models\cyb;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Operacion extends Model
{
    use LogsActivity;

    protected $table = 'operacion';
    protected $fillable = ['ope_empresa','ope_terminal'];
    protected static $logName = 'operacion';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;


}
