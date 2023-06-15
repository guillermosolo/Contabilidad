<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class TipoCombustible extends Model
{
    use LogsActivity;

    protected $table = 'tipocombustible';
    protected $fillable = ['tco_nombre', 'tco_idp'];
    protected $guarded = 'tco_id';
    protected $primaryKey = 'tco_id';
    protected static $logName = 'tipoCombustible';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function getCombustibles()
    {
        $combustibles = new TipoCombustible();
        return $combustibles->get();
    }
}
