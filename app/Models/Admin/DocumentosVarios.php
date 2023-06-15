<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class DocumentosVarios extends Model
{
    use LogsActivity;

    protected $table = 'documentosVarios';
    protected $fillable = ['docv_fecha','docv_formularioSAT','docv_numero','docv_persona','docv_monto','docv_empresa','docv_terminal','docv_correlativoInt','docv_tipo'];
    protected $guarded = 'docv_id';
    protected $primaryKey = 'docv_id';
    protected static $logName = 'DocumentosVarios';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

}
