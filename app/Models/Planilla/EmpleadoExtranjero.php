<?php

namespace App\Models\Planilla;

use Illuminate\Database\Eloquent\Model;

class EmpleadoExtranjero extends Model
{
    protected $table = 'trabajoextranjero';
    protected $primaryKey = ['trex_id','trex_empleado'];
    protected $guarded = [''];
    public $incrementing = false;


    public function Pais()
    {
        return $this->belongsTo('App\Models\Admin\Paises', 'trex_pais','pai_id');
    }
}
