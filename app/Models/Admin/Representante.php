<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Representante extends Model
{
    use LogsActivity;

    protected $table = 'representante';
    protected $fillable = ['repr_nombre', 'repr_NIT'];
    protected $guarded = 'repr_id';
    protected $primaryKey = 'repr_id';
    protected static $logName = 'representante';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function Empresas()
    {
        return $this->belongsToMany('App\Models\Paramentros\Empresa','representacion','rep_representante','rep_empresa')->withTimestamps();
    }

    public function getRepresentantes(){
        $representantes = new Representante();
        return $representantes->orderBy('repr_nombre')->get();
    }
}
