<?php

namespace App\Models\Planilla;

use Illuminate\Database\Eloquent\Model;

class EnlaceDescBon extends Model
{
    protected $table = 'enlacedescbon';
    protected $primaryKey = ['edb_empleado','edb_descbon'];
    protected $guarded = [''];
    public $incrementing = false;


}
