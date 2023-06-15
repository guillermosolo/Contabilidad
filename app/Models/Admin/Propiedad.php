<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Propiedad extends Model
{
    use LogsActivity;

    protected $table = 'propiedad';
    protected $fillable = ['prop_nombre'];
    protected $guarded = 'prop_id';
    protected $primaryKey = 'prop_id';
    protected static $logName = 'prop';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public static function getPropiedades()
      {
          $prop = new Propiedad();
          return $prop->orderBy('prop_id')->get();
      }
}
