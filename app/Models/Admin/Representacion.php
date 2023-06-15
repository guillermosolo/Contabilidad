<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Representacion extends Model
{
    use LogsActivity;

    protected $table = 'representacion';
    protected $fillable = ['rep_empresa', 'rep_representante','rep_inicio','rep_fin','rep_constancia','rep_tipo'];
    protected static $logName = 'representacion';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;
}
