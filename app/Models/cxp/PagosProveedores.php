<?php

namespace App\Models\cxp;

use App\Models\Admin\DocumentosVarios;
use Illuminate\Database\Eloquent\Model;

class PagosProveedores extends Model
{
    protected $table = 'pagosProveedores';
    protected $fillable = ['pap_documento','pap_monto','pap_tipoPago','pap_referencia','pap_fecha','pap_tipoDoc'];
    protected $guarded = 'pap_id';
    protected $primaryKey = 'pap_id';
    protected static $logName = 'PagosProveedores';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function TipoPago(){
        return $this->belongsTo('App\Models\Admin\TipoPago','pap_tipoPago','tip_id');
    }

    public function Referencia(){
        if($this->TipoPago->tip_tabla == "V"){
            $referencia = DocumentosVarios::where('docv_id',$this->pap_referencia)->first();
            return $referencia;
        }
        return "mal camino";
    }
}
