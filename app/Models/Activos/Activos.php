<?php

namespace App\Models\Activos;


use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Activos extends Model
{
    use LogsActivity;

    protected $table = 'activos';
    protected $fillable = ['act_descripcion','act_categoria', 'act_correlativo', 'act_serie', 'act_fechaAlta', 'act_valor', 'act_status', 'act_cuentaDep', 'act_cuentaDepAcum', 'act_fechaBaja', 'act_propio', 'act_inicial', 'act_porcentaje', 'act_empresa', 'act_terminal'];
    protected $guarded = 'act_id';
    protected $primaryKey = 'act_id';
    protected static $logName = 'Activos';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function Terminal()
    {
        return $this->belongsTo('App\Models\Parametros\Terminal','act_terminal', 'ter_id');
    }

    public function Empresa()
    {
        return $this->belongsTo('App\Models\Parametros\Empresa', 'act_empresa', 'emp_id');
    }

    public function StatusActivos()
    {
        return $this->belongsTo('App\Models\Admin\StatusActivos', 'act_status', 'sta_id');
    }

    public function Categoria()
    {
        return $this->belongsTo('App\Models\Admin\Categoria', 'act_categoria', 'cat_id');
    }

    public function CuentaContable()
    {
        return $this->belongsTo('App\Models\Contabilidad\CuentaContable', 'act_cuentaDepAcum', 'cta_id');
    }

    public function Propiedades()
    {
        return $this->belongsToMany('App\Models\Admin\Propiedad','adicionales','adi_activo','adi_propiedad')->withTimestamps()->withPivot('adi_valor');
    }

}


