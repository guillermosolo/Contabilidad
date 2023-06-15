<?php

namespace App\Models\Planilla;

use Illuminate\Database\Eloquent\Model;

class EmpleadoIdioma extends Model
{

    protected $table = 'empleadoidiomas';
    protected $primaryKey = ['ei_empleado','ei_idioma'];
    protected $guarded = [''];
    public $incrementing = false;


}
