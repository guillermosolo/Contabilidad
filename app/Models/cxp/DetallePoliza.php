<?php

namespace App\Models\cxp;

use Illuminate\Database\Eloquent\Model;

class DetallePoliza extends Model
{
    protected $table = 'detallepoliza';
    protected $fillable = ['detp_poliza','detp_cantidad','detp_descripcion','detp_fob','detp_flete','detp_seguro','detp_iva','detp_tipoGasto'];
    protected $guarded = 'detp_id';
    protected $primaryKey = 'detp_id';

    public function TipoGasto(){
        return $this->belongsTo('App\Models\Contabilidad\CuentaContable','detp_tipoGasto','cta_id');
    }
}
