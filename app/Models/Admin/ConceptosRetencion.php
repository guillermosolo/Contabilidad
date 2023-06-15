<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ConceptosRetencion extends Model
{
    use LogsActivity;

    protected $table = 'conceptosretencion';
    protected $fillable = ['conR_descripcion'];
    protected $guarded = 'conR_id';
    protected $primaryKey = 'conR_id';
    protected static $logName = 'ConceptosRetencion';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public static function getConceptos()
    {
        $con = new ConceptosRetencion();
        return $con->orderBy('conr_id')->get();
    }

}
