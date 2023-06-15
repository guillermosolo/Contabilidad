<?php

namespace App\Models\cxp;

use Illuminate\Database\Eloquent\Model;

class DetalleCompras extends Model
{
    protected $table = 'detallecompras';
    protected $fillable = ['detc_documento','detc_descripcion','detc_precioU','detc_cantidad','detc_tipoGasto','detc_tipoComb'];
    protected $guarded = 'detc_id';
    protected $primaryKey = 'detc_id';

    public function TipoGasto(){
        return $this->belongsTo('App\Models\Contabilidad\CuentaContable','detc_tipoGasto','cta_id');
    }

    public function Combustible(){
        return $this->belongsTo('App\Models\Admin\TipoCombustible','detc_tipoComb','tco_id');
    }
}
