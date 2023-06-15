<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class TipoPago extends Model
{
    use LogsActivity;

    protected $table = 'tipopago';
    protected $fillable = ['tip_nombre','tip_referencia', 'tip_tabla'];
    protected $guarded = 'tip_id';
    protected $primaryKey = 'tip_id';
    protected static $logName = 'tipoPago';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;
}

