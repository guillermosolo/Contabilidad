<?php

namespace App\Http\Controllers\Planillas;

use App\Exports\Planilla\ReporteEstadisticoExport;
use App\Exports\Planilla\ReporteEstadistoEmpresaExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Planillas\ValidacionPrestacionLaboral;
use App\Http\Requests\Planillas\ValidacionReportes;
use App\Models\Parametros\Empresa;
use App\Models\Planilla\Empleado;
use App\Models\Planilla\EmpleadoExtranjero;
use App\Models\Planilla\EmpleadoIdioma;
use App\Models\Planilla\Planilla;
use App\Models\Planilla\ReporteAusencia;
use App\Models\Planilla\ReporteHoraExtra;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Storage;

class ReporteEstadisticoController extends Controller
{

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\Http\Response|View
     */
    public function create()
    {
        return view('planillas.reportes.estadistico.crear');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ValidacionPrestacionLaboral $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function store(ValidacionReportes $request)
    {
        $data = $request->validated();
        $data['fecha']= Carbon::parse(Carbon::createFromFormat('d/m/Y', $data['fecha']));
        $datas = $this->getReporte($data);
        $empresa = Empresa::find($data['empresa']);
        $nameTemp = '/public/REPORTEESTADISTICO'. $empresa->emp_sigla. now()->format('Y-m-d').'.xlsx' ;
        $name = 'REPORTE ESTADISTICO DE '. Empresa::find($data['empresa'])->emp_siglas. '.xlsx' ;
        Excel::store(new ReporteEstadisticoExport($datas), $nameTemp);
        Excel::store(new ReporteEstadistoEmpresaExport($empresa,$nameTemp), $nameTemp);
        return response()->download(storage_path('app/'.$nameTemp) ,$name)->deleteFileAfterSend();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    private  function getReporte($data){
        $empleados = Empleado::where('empl_empresa',$data['empresa'])->where('empl_tipoSalario','=','M')->get();
        $empleados->map(function ($emp) use($data)  {
            $salario =  $emp->empl_salario;
            $fechaInicioEmpleado = Carbon::parse($emp->empl_inicio);
            $year = intval($data['fecha']->format('Y'));
            $emp->nombre = $emp->getNombreCompleto($emp->empl_id);
            $emp->extranjero = EmpleadoExtranjero::where('trex_empleado', $emp->empl_id)->first();
            $emp->idiomas =implode(",", EmpleadoIdioma::where('ei_empleado', $emp->empl_id)->get()->pluck('ei_idioma')->toArray()) ;
            $emp->salario_anual = round( $emp->empl_salario*12,2);
            $emp->bonificacion = 250;
            $emp->horasExtras = $this->getHorasExtras($emp->empl_id,$data['fecha']);
            $emp->valorHoraExtra = round( (($emp->empl_salario/30)/8)*1.5,2);
            $emp->diasLab=$this->calcDiasLab($emp,$data['fecha']);

            $emp->bono14   =(new Planilla())->calcBonificacionesAB($salario,$fechaInicioEmpleado,$year,'N',$data['fecha'])['monto'];
            $emp->aguinaldo=(new Planilla())->calcBonificacionesAB($salario,$fechaInicioEmpleado,$year,'A',$data['fecha'])['monto'];
        });
        return $empleados;
    }
    private function getHorasExtras($emp,$fecha): int
    {
        $fechaInicio = $fecha->subMonths(12)->format('Y-m-d');
        $reporte = ReporteHoraExtra::where('ree_empleado', $emp)
            ->where(function ($query) use ($fechaInicio) {
                $query = $query->where('ree_fecha', '>=',$fechaInicio);
            })
            ->where('ree_tipo','=','E')
            ->sum('ree_horas');
        $fecha->addMonths(12);
        return $reporte ? intval( $reporte) : 0;
    }
    public function calcDiasLab($empleado,$fecha){
        $fechaCalculo = Carbon::createFromDate($fecha)->subMonths(12);
        $fechaInicioEmpleado =  Carbon::parse($empleado->empl_inicio);
        $diasTrabajados = $fechaCalculo>$fechaInicioEmpleado?$fechaCalculo->diffInDays($fecha)+1:$fechaInicioEmpleado->diffInDays($fecha)+1;
        $diasAusente = 0;
        $reporte = Reporteausencia::where('rea_empleado', $empleado->empl_id)
            ->where('rea_inicio', '>=', $fechaCalculo->format('Y-m-d'))
            ->where('rea_inicio', '>=',$fechaInicioEmpleado->format('Y-m-d'))
            ->get();
        foreach ($reporte as $re) {
            $inicio = Carbon::parse($re->rea_inicio);
            $fin = Carbon::parse($re->rea_fin);
            $dias = $inicio->diffInDays($fin);
            $diasAusente += $dias + 1;
        }
        $diasTrabajados -=  $diasAusente;
        return $diasTrabajados;
    }

    public function exportarExcel($datas): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $datas = decrypt($datas);

    }

}
