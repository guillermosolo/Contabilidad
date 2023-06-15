<?php

namespace App\Models\Planilla;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class Empleado extends Model
{
    use LogsActivity;


    protected $table = "empleados";
    protected $guarded = [''];
    protected $primaryKey = 'empl_id';
    protected static $logName = 'empleados';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function getNombreCompleto($param)
    {
        $emp = new Empleado();
        $nombre = $emp->where('empl_id', '=', $param)->first();
        $completo = $nombre['empl_nom1'] . ' ' . $nombre['empl_nom2'] . ' ' . $nombre['empl_ape1'] . ' ' . $nombre['empl_ape2'];
        return $completo;
    }

    public static function getEmpleados()
    {
        $empleados = new Empleado();
        return $empleados->where('empl_retiro', null)->orderBy('empl_id')->get();
    }

    public static function getIdiomas($id)
    {
        return DB::table('empleadoidiomas')
            ->join('idiomas', 'idiomas.idi_id', '=', 'empleadoidiomas.ei_idioma')
            ->select(DB::raw("STRING_AGG(idiomas.idi_descripcion ,',') as data"))
            ->where('ei_empleado', $id)
            ->first()->data;
    }

    public static function getExtranjero($id)
    {
        return DB::table('trabajoextranjero')
            ->join('paises', 'paises.pai_id', '=', 'trabajoextranjero.trex_pais')
            ->select(DB::raw("STRING_AGG(concat(paises.pai_descripcion,' ',trabajoextranjero.trex_ocupacion) ,',') as data"))
            ->where('trabajoextranjero.trex_empleado', $id)
            ->first()->data;
    }

    public static function getSalarioPromedio($empleado, $fecha, $numPromedio = 6)
    {
        $subtotal = 0;
        $mesInicial = intval($fecha->format('m'));
        $year = intval($fecha->format('Y'));

        $valorInit = $numPromedio;
        $empObject = new Empleado();
        for ($x = 0; $x < $valorInit; $x++) {
            $planillaObject = new Planilla();
            $horasExtras = $empObject->getTipoDesc($empleado,$mesInicial,$year,'E');
            $salarioBase =round($empObject->getTipoDescEs($empleado,$mesInicial,$year,'S'),2);
            $horasOrdinarias =$empObject->getTipoDesc($empleado,$mesInicial,$year,'O');
            $diasLab =$empObject->getTipoDesc($empleado,$mesInicial,$year,'L');
            $valorHoraOrdinaria = $planillaObject->getValorOrdinaria($salarioBase);
            $sueldoOrdinarioExtra = $planillaObject->getSueldoOrdinarioExtra($valorHoraOrdinaria, $horasOrdinarias);
            $sueldoOrdinaro = $planillaObject->getSueldoOrdinario($salarioBase, $diasLab, $sueldoOrdinarioExtra);
            $valorHoraExtra = $planillaObject->getValorHoraExtra($salarioBase);
            $sueldoExtra = $planillaObject->getSueldoExtra($valorHoraExtra, $horasExtras);
            $sueldoTotal = $planillaObject->getSueldoTotal($sueldoExtra, $sueldoOrdinaro);
            $subtotal +=  round($sueldoTotal,2);
            if ($mesInicial-1>0){
                $mesInicial--;
            }else{
                $mesInicial=12;
                $year--;
            }
            if ($sueldoTotal == 0) {
                $numPromedio--;
            }
        }
        if ($numPromedio==0){
            $numPromedio= 1;
        }
        return round($subtotal / $numPromedio, 2);
    }
    private static function getTipoDesc($empleado, $mes,$year,$tipo)
    {
      return DB::table('detalleplanilla as d')
          ->join('planilla as p ', 'p.pla_id', '=', 'd.detp_planilla')
          ->join('tipodesc as t', 'd.dept_tipo', '=', 't.tipd_id')
          ->where('p.pla_tipo', '=', 'O')
          ->where('d.dept_empleado', '=', $empleado)
          ->whereRaw($year . '=' . "CONVERT(INT,FORMAT ([p].[pla_inicio], 'yyyy'))")
          ->whereRaw($mes . '=' . "CONVERT(INT,FORMAT ([p].[pla_inicio],  'MM'))")
          ->where('t.tipd_clase', '=', $tipo)->sum('d.dept_monto');
    }
    private static function getTipoDescEs($empleado, $mes,$year,$tipo)
    {
        $data= DB::table('detalleplanilla as d')
            ->join('planilla as p ', 'p.pla_id', '=', 'd.detp_planilla')
            ->join('tipodesc as t', 'd.dept_tipo', '=', 't.tipd_id')
            ->where('p.pla_tipo', '=', 'O')
            ->where('d.dept_empleado', '=', $empleado)
            ->whereRaw($year . '=' . "CONVERT(INT,FORMAT ([p].[pla_inicio], 'yyyy'))")
            ->whereRaw($mes . '=' . "CONVERT(INT,FORMAT ([p].[pla_inicio],  'MM'))")
            ->select('dept_monto')
            ->where('t.tipd_clase', '=', $tipo)->first();
        return $data?$data->dept_monto:0;
    }
    public function Usuario()
    {
        return $this->hasOne('App\Models\Parametros\Usuario', 'usu_empleado');
    }

    public function Nacionalidad()
    {
        return $this->belongsTo('App\Models\Admin\Paises', 'empl_nacionalidad', 'pai_id');
    }

    public function Discapacidad()
    {
        return $this->belongsTo('App\Models\Admin\Discapacidad', 'empl_discapacidad', 'dis_id');
    }

    public function Origen()
    {
        return $this->belongsTo('App\Models\Admin\Paises', 'empl_origen', 'pai_id');
    }

    public function Nacimiento()
    {
        return $this->belongsTo('App\Models\Admin\DepMun', 'empl_lugNac', 'dep_id');
    }

    public function Pueblo()
    {
        return $this->belongsTo('App\Models\Admin\Pueblo', 'empl_pueblo', 'pue_id');
    }

    public function Terminal()
    {
        return $this->belongsTo('App\Models\Parametros\Terminal', 'empl_terminal', 'ter_id');
    }

    public function Empresa()
    {
        return $this->belongsTo('App\Models\Parametros\Empresa', 'empl_empresa', 'emp_id');
    }

    public function Academico()
    {
        return $this->belongsTo('App\Models\Admin\Academico', 'empl_nivelAcad', 'aca_id');
    }
}

