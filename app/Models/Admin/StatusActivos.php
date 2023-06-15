<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class StatusActivos extends Model
{
    use LogsActivity;

    protected $table = 'statusactivos';
    protected $fillable = ['sta_descripcion','sta_baja'];
    protected $guarded = 'sta_id';
    protected $primaryKey = 'sta_id';
    protected static $logName = 'statusactivos';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public static function getStatusActivos()
      {
          $status = new StatusActivos();
          return $status->where('sta_id', 'LIKE', '[0-88]' )->where('sta_baja', 'LIKE', '[0-1]%')->orderBy('sta_descripcion')->get();
          
      }

}
