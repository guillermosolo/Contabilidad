<?php

namespace App\Models\Parametros;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;



class Terminal extends Model
{
    use LogsActivity;

    protected $table = 'terminal';
    protected $fillable = ['ter_id','ter_nombre', 'ter_abreviatura', 'ter_municipio','ter_activo','ter_autoriza'];
    protected $guarded = 'ter_id';
    protected $primaryKey = 'ter_id';
    protected static $logName = 'terminal';
    protected static $ignoreChangedAttributes = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function Departamento()
  {
    return $this->belongsTo('App\Models\Admin\DepMun', 'ter_municipio', 'dep_id');
  }

  public function Empresas()
  {
    return $this->belongsToMany('App\Models\Parametros\Empresa','operacion','ope_terminal','ope_empresa')->withTimestamps();
  }

  public static function getTerminales()
  {
      $terminal = new Terminal();
      return $terminal->where('ter_id', '>', '0')->orderBy('ter_id')->get();
  }

  public function Prod()
    {
        return $this->belongsTo('App\Models\Cxc\Productos', 'prod_terminal', 'ter_id');
    }

    public function OrdenFac()
    {
        return $this->belongsTo('App\Models\Cxc\OrdenFacturacion', 'ordf_terminal', 'ter_id');
    }

    public function Facturacion()
    {
        return $this->belongsTo('App\Models\Cxc\Facturacion', 'ven_terminal', 'ter_id');
    }

  public function getTerminal($param)
  {
      $ter = new Terminal();
      $terminal = $ter->where('ter_id', '=', $param)->first();
      $nombre = $terminal['ter_nombre'].''. $terminal['ter_siglas'];
      return $nombre;
  }

  public function getTermi($param)
  {
      $ter = new Terminal();
      $abreviatura = $ter->where('ter_id', '=', $param)->first();

      return $abreviatura;
  }



}
