<?php

namespace App\Http\Controllers\Planillas;

use App\Exports\DocumentosRecibidosExport;
use App\Exports\Planilla\PlanillaMensualExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Planillas\ValidacionGeneracionPlanilla;
use App\Models\Contabilidad\CuentaContable;
use App\Models\Planilla\DescBon;
use App\Models\Planilla\DetallePlanilla;
use App\Models\Planilla\Empleado;
use App\Models\Planilla\Planilla;
use App\Models\Planilla\ReporteAusencia;
use App\Models\Planilla\ReporteHoraExtra;
use App\Models\Planilla\ReporteTurnos;
use App\Models\Planilla\ReporteTurnosBarcos;
use App\Models\Planilla\TiposDesc;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class  PlanillaMensualController extends Controller
{
    public $tipoQuincena;

    public function index(Request $request)
    {
        $pla = new Planilla();
        $datas = $pla->getPlanilla('O');
        return view('planillas.generacion.mensual.index', compact('datas'));
    }


    public function create(Request $request)
    {
        $year= (new Planilla())->getFirstYear() ;
        $limitYear = now()->format('Y')-$year;
        return view('planillas.generacion.mensual.crear', compact('year','limitYear'));
    }

    /**
     * @throws ValidationException
     */
    public function store(ValidacionGeneracionPlanilla $request)
    {
        $data = $request->validated();
        $this->tipoQuincena = $data['pla_tipo_quincena'];
        $fechaPla =  now()->year($data['pla_fecha']);
        $fecha = $this->tipoQuincena == 0 ? $fechaPla->month($data['pla_mes'])->day(15) : $fechaPla->month($data['pla_mes'])->endOfMonth();
        $dataDesc = $this->validarOrdinaria($data['pla_empresa'], $data['pla_terminal'], $fecha);
        $data['pla_inicio'] = $this->tipoQuincena == 0 ? $fecha->day(1)->format('Y-m-d') : $fecha->day(16)->format('Y-m-d');
        $data['pla_fin'] = $this->tipoQuincena == 0 ? $fecha->day(15)->format('Y-m-d') : $fecha->endOfMonth()->format('Y-m-d');
        return $this->insertMensual($data, $dataDesc['descbono'], $dataDesc['empleados']);

    }


    public function show($id)
    {
        $datas = $this->calcularSalariosMensual($id);

        return view('planillas.generacion.mensual.show', ['datas' => $datas['empleados'], 'totales' => $datas['totales'], 'dataPlanilla' => $datas['dataPlanilla'], 'id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            try {
                DetallePlanilla::where('detp_planilla', $id)->delete();
                Planilla::where('pla_id', $id)->delete();
            } catch (Exception $e) {
                return back()->withErrors(['catch', $e->errorInfo]);
            }
            return back()->with('mensaje', 'Planilla eliminada con exito.');
        });
    }

    /**
     * @throws ValidationException
     */
    private function validarOrdinaria($emp, $ter, $fecha)
    {
        $planilla = Planilla::where('pla_fin', $fecha)->where('pla_tipo',"=",'O') ->first();
        if ($planilla) {
            throw ValidationException::withMessages(['Ya existe una planilla con esta fecha']);
        }
        $desc = DB::table('descbon as d')
            ->join('cuentacontable as c', 'c.cta_id', '=', 'd.desc_cuentaContable')
            ->join('tipodesc as t', 't.tipd_id', '=', 'd.desc_tipo')
            ->select('d.*', 't.tipd_forma', 't.tipd_clase', 'c.cta_empresa')
            ->where('c.cta_empresa', $emp)
            ->where(function ($query) use ($fecha) {
                $query = $query->orWhere('d.desc_fin', null);
                $query = $query->orWhereRaw("'" . $fecha->format('Y-m-d') . "'" . '<=' . '[d].[desc_fin]');
            })
            ->whereRaw("'" . $fecha->format('Y-m-d') . "'" . '>=' . '[d].[desc_inicio]')
            ->get();
        if ($desc->first() == null) {
            throw ValidationException::withMessages(['No existe ninguna bonificacion ni descuento en el sistema']);
        }
        $empleado = DB::table('empleados as e')->select('e.empl_id', 'e.empl_salario')
            ->where('e.empl_terminal', $ter)
            ->where('e.empl_empresa', $emp)
            ->where(function ($query) use ($fecha) {
                $query = $query->orWhere('e.empl_retiro', null);
                $query = $query->orWhereRaw("'" . $fecha . "'" . '<=' . '[e].[empl_retiro]');
            })
            ->where('e.empl_inicio', "<=", $fecha)
            ->where('e.empl_tipoSalario', '=', 'M')
            ->get();
        if ($empleado->first() == null) {
            throw ValidationException::withMessages(['No existe ningun empleado registrado en la terminal seleccionada']);
        }
        return collect(['descbono' => $desc, 'empleados' => $empleado]);
    }

    private function insertMensual($dataPlanilla, $dataBono, $dataEmpleado)
    {
        try {
            DB::transaction(function () use ($dataPlanilla, $dataBono, $dataEmpleado) {
                $dataPlanilla['pla_liquidacion'] = 0;
                $planilla = Planilla::create($dataPlanilla);

                $this->insertDetalleExtra($dataEmpleado, $planilla);
                foreach ($dataBono as $bono) {
                    if ($bono->desc_general == 1) {
                        $this->insertDataM($dataEmpleado, $bono, $planilla);
                    } elseif ($bono->desc_general == 0) {
                        $empleados = DB::table('enlacedescbon as enlace')
                            ->join('empleados as e', 'e.empl_id', '=', 'enlace.edb_empleado')
                            ->where('enlace.edb_descbon', $bono->desc_id)
                            ->where('e.empl_empresa', $dataPlanilla['pla_empresa'])
                            ->where('e.empl_terminal', $dataPlanilla['pla_terminal'])
                            ->select('e.empl_id', 'e.empl_salario')->get();
                        $this->insertDataM($empleados, $bono, $planilla);
                    }
                }
            });
        } catch (Exception $e) {
            return redirect('planillas/generacion/mensual/crear')->withErrors(['catch2', $e->getMessage()]);
        }
        return redirect('planillas/generacion/mensual')->with('mensaje', 'Planilla  creada con exito.');

    }

    private function insertDetalleExtra($empleados, $planilla)
    {
        $tipoSalario = TiposDesc::where('tipd_clase', '=', 'S')->first();
        $tipoExtra = TiposDesc::where('tipd_clase', '=', 'E')->first();
        $tipoOrdinaria = TiposDesc::where('tipd_clase', '=', 'O')->first();
        $tipoDias = TiposDesc::where('tipd_clase', '=', 'L')->first();
        foreach ($empleados as $emp) {
            DetallePlanilla::create(['detp_planilla' => $planilla->pla_id, 'dept_empleado' => $emp->empl_id, 'dept_tipo' => $tipoSalario->tipd_id, 'dept_monto' => $emp->empl_salario]);
            DetallePlanilla::create(['detp_planilla' => $planilla->pla_id, 'dept_empleado' => $emp->empl_id, 'dept_tipo' => $tipoDias->tipd_id, 'dept_monto' => $this->getDiasTrabajados($planilla, $emp)]);
            DetallePlanilla::create(['detp_planilla' => $planilla->pla_id, 'dept_empleado' => $emp->empl_id, 'dept_tipo' => $tipoExtra->tipd_id, 'dept_monto' => $this->getHoras($planilla, $emp,'E')]);
            DetallePlanilla::create(['detp_planilla' => $planilla->pla_id, 'dept_empleado' => $emp->empl_id, 'dept_tipo' => $tipoOrdinaria->tipd_id, 'dept_monto' => $this->getHoras($planilla, $emp,'O')]);

        }
    }

    private function getDiasTrabajados($planilla, $empleado): int
    {
        $diasAusente = 0;
        $reporte = Reporteausencia::where('rea_empleado', $empleado->empl_id)
            ->where(function ($query) use ($planilla) {
                $query = $query->where('rea_inicio', '>=', $planilla->pla_inicio);
                $query = $query->where('rea_fin', '<=', $planilla->pla_fin);
            })->get();
        foreach ($reporte as $re) {
            $inicio = Carbon::parse($re->rea_inicio);
            $fin = Carbon::parse($re->rea_fin);
            $dias = $inicio->diffInDays($fin);
            $diasAusente += $dias + 1;
        }
        $diasTrabajados = 15 - $diasAusente;
        if ($diasAusente > 0) {
            if ($diasTrabajados >= 6) {
                $diasTrabajados -= 1;
            } else {
                $diasTrabajados -= 2;
            }
        }
        return $diasTrabajados;
    }

    private function getHoras($planilla, $emp,$tipo)
    {
        $reporte = ReporteHoraExtra::where('ree_empleado', $emp->empl_id)
            ->where(function ($query) use ($planilla) {
                $query = $query->where('ree_fecha', '>=', $planilla->pla_inicio);
                $query = $query->where('ree_fecha', '<=', $planilla->pla_fin);
            })
            ->where('ree_tipo',$tipo)
            ->sum('ree_horas');
        return $reporte ? intval( $reporte) : 0;
    }

    private function insertDataM($empleados, $bono, $planilla)
    {
        foreach ($empleados as $emp) {
            $detalle = new DetallePlanilla();
            $detalle->detp_planilla = $planilla->pla_id;
            $detalle->dept_empleado = $emp->empl_id;
            $detalle->dept_tipo = $bono->desc_tipo;
            if ($bono->tipd_forma == 'P') {
                $detalle->dept_monto = $this->calcMonto((($bono->desc_monto / 100) * $emp->empl_salario));
            } elseif ($bono->tipd_forma == 'F') {
                $detalle->dept_monto = $this->calcMonto($bono->desc_monto);
            }
            $detalle->save();
        }
    }
    private function calcularSalariosMensual($id): array
    {
        $pla = Planilla::find($id);
        $dataEmpleado = DB::table('detalleplanilla as d')
            ->where('d.detp_planilla', $id)->select('d.dept_empleado as empleado')->groupBy('d.dept_empleado')->get();
        $empleados = $this->mapEmpleados($dataEmpleado);
        foreach ($empleados as $key => $emp) {
            $detalles = $pla->getBonificaciones($id, $emp->empleado);
            $salarioBase = $detalles->firstWhere('tipd_clase', '=', 'S')->dept_monto;
            $diasLab = $detalles->firstWhere('tipd_clase', '=', 'L')->dept_monto;
            $horasExtra = $detalles->firstWhere('tipd_clase', '=', 'E')->dept_monto;
            $horasOrdinales = $detalles->firstWhere('tipd_clase', '=', 'O')->dept_monto;
            $bonificacion_incentivo = $detalles->where('tipd_descripcion', '=', 'BONIFICACION INCENTIVO')->sum('dept_monto');
            $bonificaciones = $detalles->where('tipd_clase', '=', 'B')->sum('dept_monto')-$bonificacion_incentivo;
            $totalBonificaciones = $bonificacion_incentivo+$bonificaciones;
            $prestamos = $detalles->filter(function ($item) {
                return false !== stristr(strtoupper($item->tipd_descripcion), 'PRESTAMO');
            })->sum('dept_monto');
            $anticipos = $detalles->filter(function ($item) {
                return false !== stristr(strtoupper($item->tipd_descripcion), 'ANTICIPO');
            })->sum('dept_monto');
            $isr = $detalles->filter(function ($item) {
                return false !== stristr(strtoupper($item->tipd_descripcion), 'ISR');
            })->sum('dept_monto');
            $otros = ($detalles->sum('dept_monto') - ($salarioBase+$isr + $totalBonificaciones  + $prestamos + $anticipos + $diasLab + $horasExtra + $horasOrdinales));
            $valorHoraOrdinaria = $pla->getValorOrdinaria($salarioBase);
            $sueldoOrdinarioExtra = $pla->getSueldoOrdinarioExtra($valorHoraOrdinaria, $horasOrdinales);
            $sueldoOrdinaro = $pla->getSueldoOrdinario($salarioBase, $diasLab, $sueldoOrdinarioExtra);
            $valorHoraExtra = $pla->getValorHoraExtra($salarioBase);
            $sueldoExtra = $pla->getSueldoExtra($valorHoraExtra, $horasExtra);
            $sueldoTotal = $pla->getSueldoTotal($sueldoExtra, $sueldoOrdinaro);
            $igss = $pla->getIgss($sueldoTotal);
            $totalDescuentos = round($igss + $prestamos + $anticipos + $otros+$isr,2);
            $igssPatronal = round($sueldoTotal * (12.67 / 100), 2);

            $empleados[$key]->diasLab = intval($diasLab);
            $empleados[$key]->horas_extras = intval($horasExtra);
            $empleados[$key]->sueldo_extra = $sueldoExtra;
            $empleados[$key]->igss = $igss;
            $empleados[$key]->isr = $isr;
            $empleados[$key]->prestamos = $prestamos;
            $empleados[$key]->anticipos = $anticipos;
            $empleados[$key]->otros = $otros;
            $empleados[$key]->totalDescuentos = $totalDescuentos;
            $empleados[$key]->subtotal = $sueldoOrdinaro + $totalBonificaciones + $sueldoExtra;
            $empleados[$key]->bonificacion_incentivo = $bonificacion_incentivo;
            $empleados[$key]->bonificaciones = $bonificaciones;
            $empleados[$key]->sueldoMensual = $salarioBase;
            $empleados[$key]->igssPatronal =$igssPatronal;
            $empleados[$key]->sueldoOrdinario =$sueldoOrdinaro;
            $empleados[$key]->sueldoLiquido = round(($sueldoOrdinaro + $sueldoExtra ) - $totalDescuentos + $totalBonificaciones,2);
        }
        $totales = $this->getTotales($empleados);
        $planilla = $this->getDataPlanilla($pla);
        return ['empleados' => $empleados, 'totales' => $totales, 'dataPlanilla' => $planilla];
    }

    private function mapEmpleados($empleados)
    {
        $empObject = new Empleado();
        $empleados->map(function ($emp) use ($empObject) {
            $emp->nombre = $empObject->getNombreCompleto($emp->empleado);
            $emp->bonificaciones = 0.00;
            $emp->horas_extras = 0;
            $emp->sueldo_extra = 0.00;
            $emp->bonificacion_incentivo = 0.00;
            $emp->bonificaciones = 0.00;
            $emp->sueldoMensual = 0.00;
            $emp->sueldoOrdinario = 0.00;
            $emp->sueldoLiquido = 0.00;
            $emp->igss = 0.00;
            $emp->isr = 0.00;
            $emp->prestamos = 0.00;
            $emp->anticipos = 0.00;
            $emp->otros = 0.00;
            $emp->totalDescuentos = 0.00;
            $emp->subtotal = 0.00;
            $emp->igssPatronal = 0.00;
            $emp->diasLab = 15;
        });
        return $empleados;
    }

    private function getTotales($empleados)
    {
        $totales = ['diasLab' => 0, 'bonificaciones' => 0, 'bonificacion_incentivo' => 0, 'sueldoMensual' => 0, 'sueldoOrdinario' => 0, 'sueldoLiquido' => 0, 'igss' => 0, 'prestamos' => 0, 'anticipos' => 0,
            'otros' => 0, 'isr' => 0, 'totalDescuentos' => 0, 'subtotal' => 0, 'horas' => 0, 'sueldo_extra' => 0,'igssPatronal'=>0];
        foreach ($empleados as $emp) {
            $totales['bonificacion_incentivo'] += $emp->bonificacion_incentivo;
            $totales['bonificaciones'] += $emp->bonificaciones;
            $totales['sueldoMensual'] += $emp->sueldoMensual;
            $totales['sueldoOrdinario'] += $emp->sueldoOrdinario;
            $totales['sueldoLiquido'] += $emp->sueldoLiquido;
            $totales['igss'] += $emp->igss;
            $totales['isr'] += $emp->isr;
            $totales['prestamos'] += $emp->prestamos;
            $totales['anticipos'] += $emp->anticipos;
            $totales['otros'] += $emp->otros;
            $totales['totalDescuentos'] += $emp->totalDescuentos;
            $totales['subtotal'] += $emp->subtotal;
            $totales['diasLab'] += $emp->diasLab;
            $totales['horas'] += $emp->horas_extras;
            $totales['igssPatronal'] += $emp->igssPatronal;
            $totales['sueldo_extra'] += $emp->sueldo_extra;
        }
        return $totales;
    }

    private function getDataPlanilla($pla): array
    {
        $fecha_fin = Carbon::parse($pla->pla_fin);
        return [
            'fecha' => $fecha_fin->format('d/m/Y')
            , 'mes' => intval($fecha_fin->format('m'))
            , 'dia' => intval($fecha_fin->format('d'))
            , 'anio' => intval($fecha_fin->format('Y'))
            , 'diaFinal' => intval($fecha_fin->endOfMonth()->format('d'))
            , 'terminal' => $pla->Terminal->ter_nombre
            , 'empresa' => $pla->Empresa->emp_nombre];
    }

    private function calcMonto($monto)
    {
        $result = $monto / 2;
        if ($this->tipoQuincena) {
            $result = round($result, 2, PHP_ROUND_HALF_UP);
        } else {
            $result = round($result, 2, PHP_ROUND_HALF_DOWN);
        }
        return $result;
    }

    public function exportarPlanillaMensualExcel($id): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $data = $this->calcularSalariosMensual($id);
        $name = ($data['dataPlanilla']['dia'] == 15 ? '1RA' : '2DA') . ' DE ' . Str::nombreMes($data['dataPlanilla']['mes']) . ' ' . $data['dataPlanilla']['anio'] . '.xlsx';
        return Excel::download(new PlanillaMensualExport($this->calcularSalariosMensual($id)), $name);
    }

    public function exportarPlanillaMensualPDF($id)
    {
        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $data = $this->calcularSalariosMensual($id);
        $pdf->loadView('planillas.generacion.exports.mensual.pdf', ['datas' => $data['empleados'], 'totales' => $data['totales'], 'dataPlanilla' => $data['dataPlanilla']])->setPaper('letter', 'landscape');
        $name = ($data['dataPlanilla']['dia'] == 15 ? '1RA' : '2DA') . ' DE ' . Str::nombreMes($data['dataPlanilla']['mes']) . ' ' . $data['dataPlanilla']['anio'] . '.pdf';
        return $pdf->download($name);
    }


}
