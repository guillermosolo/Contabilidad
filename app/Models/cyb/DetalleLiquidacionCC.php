<?php

namespace App\Models\cyb;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class DetalleLiquidacionCC extends Model
{
    use LogsActivity;

    protected $table = 'detalleliquidacioncc';
    protected $fillable = ['dlcc_id', 'dlcc_idcc', 'dlcc_fecha', 'dlcc_proveedor', 'dlcc_tipodoc', 'dlcc_seriedoc', 'dlcc_numerodoc', 'dlcc_descripcion',
        'dlcc_terminal', 'dlcc_tipogasto', 'dlcc_monto', 'dlcc_galones', 'dlcc_tipoCombustible', 'dlcc_status', 'dlcc_correlativoInt',];
    protected $guarded = 'dlcc_id';
    protected $primaryKey = 'dlcc_id';
    protected static $logName = 'detalleliquidacioncc';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function Liquidacion()
    {
        return $this->belongsTo('App\Models\cyb\LiquidacionCC', 'dlcc_idcc', 'lcc_id');
    }

    public function ProveedorDetalle()
    {
        return $this->belongsTo('App\Models\cxp\Proveedor', 'dlcc_proveedor', 'pro_id');
    }

    public function NombreCombustible()
    {
        return $this->belongsTo('App\Models\Admin\TipoCombustible', 'dlcc_tipoCombustible', 'tco_id');

    }

    public static function totalDetallesCajas($id)
    {
        return DetalleLiquidacionCC::where('dlcc_idcc', $id)->where('dlcc_status', '=', 'L')->sum('dlcc_monto');
    }

    public static function DetallesCompletos($id)
    {
        return DetalleLiquidacionCC::where('dlcc_idcc', $id)->sum('dlcc_monto');
    }

    public function DetalleContable()
    {
        return $this->belongsTo('App\Models\Contabilidad\CuentaContable', 'dlcc_tipogasto', 'cta_id');

    }

    public function DetalleTerminal()
    {
        return $this->belongsTo('App\Models\Parametros\Terminal', 'dlcc_terminal', 'ter_id');

    }
    public function CorrelativoInterno()
    {
        return $this->belongsTo('App\Models\Admin\CorrelativoInterno', 'dlcc_correlativoInt', 'corr_id');

    }
}


