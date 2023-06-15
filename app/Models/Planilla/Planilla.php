<?php

namespace App\Models\Planilla;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class Planilla extends Model
{

    use LogsActivity;

    protected $table = 'planilla';
    protected $fillable = ['pla_inicio', 'pla_fin', 'pla_descripcion', 'pla_tipo', 'pla_liquidacion', 'pla_empresa', 'pla_terminal'];
    protected $guarded = 'pla_id';
    protected $primaryKey = 'pla_id';
    protected static $logName = 'planilla';
    protected $dates = ['pla_inicio','pla_fin'];
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;


    public function getFechaInicial($fecha, $tipo): string
    {
        if ($tipo == 'N') {
            return now()->month(7)->startOfMonth()->year($fecha - 1)->format('Y-m-d');
        } else {
            return now()->month(12)->startOfMonth()->year($fecha - 1)->format('Y-m-d');
        }
    }

    public function getFechaFinal($fecha, $tipo): string
    {
        if ($tipo == 'N') {
            return now()->month(7)->startOfMonth()->year($fecha)->format('Y-m-d');
        } else {
            return now()->month(11)->endOfMonth()->year($fecha)->format('Y-m-d');
        }
    }

    public function getFirstYear(): string
    {
        $planilla = Planilla::orderBy('pla_fin', 'ASC')->first();
        if ($planilla) {
            $anio = Carbon::parse($planilla->pla_fin)->format('Y');
        } else {
            $anio = now()->format('Y');
        }
        return $anio;
    }
    public function getValorHoraExtra($salarioBase): float
    {
        return (($salarioBase / 30) / 8) * 1.5;
    }
    public function getValorOrdinaria($salarioBase): float
    {
       return round((($salarioBase / 30) / 8), 2);
    }
    public function getSueldoOrdinario($salarioBase,$diasLab,$sueldoOrdinarioExtra): float
    {
        return (($salarioBase / 30) * $diasLab)+ $sueldoOrdinarioExtra;
    }

    public function getSueldoExtra($valorHoraExtra,$horasExtra): float
    {
        return $valorHoraExtra * $horasExtra;
    }
    public function getSueldoTotal($sueldoExtra,$sueldoOrdinaro): float
    {
        return $sueldoExtra + $sueldoOrdinaro;
    }
    public function getSueldoOrdinarioExtra($valorHoraOrdinaria,$horasOrdinales): float
    {
        return $valorHoraOrdinaria * $horasOrdinales;
    }
    public function getIgss($sueldoTotal): float
    {
        return round($sueldoTotal *0.0483,2);
    }
    public function getBonificaciones($planilla, $empleado): \Illuminate\Support\Collection
    {
        return DB::table('detalleplanilla as d')
            ->join('tipodesc as t', 'd.dept_tipo', '=', 't.tipd_id')
            ->where('d.detp_planilla', $planilla)
            ->where('d.dept_empleado', '=', $empleado)
            ->select('d.dept_monto', 't.tipd_clase', 't.tipd_descripcion')
            ->get();
    }
    public function calcBonificacionesAB($salario,$inicioEmpleado,$year,$tipo,$fecha){
        $pla = new Planilla();
        $bisiesto = checkdate(2, 29, $year);
        $plaInicio = Carbon::parse($pla->getFechaInicial($year, $tipo));

        $plaFin = Carbon::parse($pla->getFechaFinal($year, $tipo));
        if ($fecha>=$plaFin){
            if ($inicioEmpleado>=$plaFin){
                $diferenciaDias = $inicioEmpleado->diffInDays($fecha)+1;
                $fechaInicioCalculo =$inicioEmpleado;
            }else{
                $diferenciaDias = $plaFin->diffInDays($fecha)+1;
                $fechaInicioCalculo =$plaFin;
            }
        }else{
            if ($inicioEmpleado>=$plaInicio){
                $diferenciaDias = $inicioEmpleado->diffInDays($fecha)+1;
                $fechaInicioCalculo =$inicioEmpleado;
            }else{
                $diferenciaDias = $plaInicio->diffInDays($fecha)+1;
                $fechaInicioCalculo =$plaInicio;
            }
        }

        $daysYear = $bisiesto ? 366 : 365;
        if ($diferenciaDias >= 365) {
            $monto = $salario;
        } else {
            $monto = ($salario / $daysYear) * $diferenciaDias;
        }
        return ['monto'=>round($monto,2),'dias'=>$diferenciaDias,'fecha'=>$fechaInicioCalculo] ;
    }
    public function getPlanilla($tipo = 'E')
    {
        $datas = Planilla::where('pla_tipo', '=', $tipo);
        if (auth()->user()->hasRole('Super Administrador')) {
            $datas = $datas->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $ter = auth()->user()->Terminales->pluck('ter_id');
            $datas = $datas->whereIn('pla_empresa', $emp)->whereIn('pla_terminal', $ter)->get();
        }
        return $datas;
    }
    public function verificarDetalles($id)
    {
        $datas = DetallePlanilla::where('detp_planilla',$id)->first();
        return $datas?:false;
    }
    public function getPlanillaEmpresa($tipo = 'E', $empresa = null, $terminal = null,$fecha=null)
    {
        return Planilla::where('pla_tipo', '=', $tipo)
            ->where('pla_empresa', $empresa)
            ->where('pla_terminal', $terminal)
            ->where('pla_inicio','<=', $fecha)
            ->where('pla_fin','>=', $fecha)
            ->get();
    }

    public function Terminal()
    {
        return $this->belongsTo('App\Models\Parametros\Terminal', 'pla_terminal', 'ter_id');
    }

    public function Empresa()
    {
        return $this->belongsTo('App\Models\Parametros\Empresa', 'pla_empresa', 'emp_id');
    }
}
