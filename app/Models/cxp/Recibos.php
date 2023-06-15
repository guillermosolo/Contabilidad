<?php

namespace App\Models\cxp;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Recibos extends Model
{
    use LogsActivity;

    protected $table = 'recibos';
    protected $fillable = ['rec_fecha','rec_nombre','rec_descripcion','rec_numDoc','rec_monto','rec_moneda','rec_tipoCambio','rec_tipoGasto','rec_empresa','rec_terminal','rec_correlativoInt'];
    protected $guarded = 'rec_id';
    protected $primaryKey = 'rec_id';
    protected static $logName = 'recibos';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function Moneda(){
        return $this->belongsTo('App\Models\Admin\Moneda', 'rec_moneda', 'mon_id');
    }

    public function Empresa(){
        return $this->belongsTo('App\Models\Parametros\Empresa','rec_empresa','emp_id');
    }

    public function Terminal(){
        return $this->belongsTo('App\Models\Parametros\Terminal','rec_terminal','ter_id');
    }

    public function Correlativo(){
        return $this->belongsTo('App\Models\Admin\CorrelativoInterno','rec_correlativoInt','corr_id');
    }
}
