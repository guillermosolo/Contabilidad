<?php

namespace App\Http\Controllers\cyb;
use App\Http\Controllers\Controller;
use App\Http\Requests\cyb\ValidacionCajaChica;
use App\Models\cyb\DetalleLiquidacionCC;
use App\Models\cyb\LiquidacionCC;
use App\Models\Planilla\Empleado;
use Illuminate\Http\Request;
use App\Models\cyb\CajaChica;
use App\Models\Contabilidad\CuentaContable;
use App\Models\Parametros\Empresa;

class CajaChicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscar=$request->get('buscar');
        if (auth()->user()->hasRole('Super Administrador'))
        {
            $cajachicas = CajaChica::orderBy('cch_id')->get();
        }else
        {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $cajachicas = CajaChica::orderBy('cch_id')->whereIn('cch_empresa', $emp)->get();
        }

        return view('cyb.cajas.responsables.index', compact('cajachicas', 'buscar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Support\Collection
     */
    public function create()
    {
        $empleados = Empleado::orderby('empl_nom1')->where('empl_id', '>', 0)->get();
        $cuentacontables = CuentaContable::orderby('cta_id')->get();
        if (auth()->user()->hasRole('Super Administrador')) {
            $empresas = Empresa::orderby('emp_id')->where('emp_id', '>', 0)->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $empresas = Empresa::orderby('emp_id')->whereIn('emp_id', $emp)->get();
        }
        return view('cyb.cajas.responsables.crear', compact('empleados', 'cuentacontables', 'empresas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionCajaChica $request)
    {
        $data = $request->validated();
        CajaChica::create($data);
        return redirect()->route('cajachica')->with('mensaje', 'Caja Chica creada con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleados = Empleado::orderby('empl_nom1')->where('empl_id', '>', 0)->get();
        $cuentacontables = CuentaContable::orderby('cta_id')->get();
        $empresas = Empresa::orderby('emp_id')->where('emp_id', '>', 0)->get();
        $cajachicas = Cajachica::find($id);
        return view('cyb.cajas.responsables.editar', compact('cajachicas', 'empleados', 'cuentacontables', 'empresas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionCajaChica $request, $id)
    {
        $cajachicas = CajaChica::find($id);
        $data = $request->validated();
        $cajachicas->fill($data);
        $cajachicas->save();
        return redirect()->route('cajachica')->with(["mensaje"=>"Registro actualizado con Éxito"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $cajachicas= CajaChica::find($id);
            $cajachicas->delete();
            return redirect()->route('cajachica')->with(["mensaje"=>"Registro eliminado con éxito"]);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('cajachica')->withErrors(['catch', $e->errorInfo]);
        }
    }

    public function indexAutorizar()
    {
        if (auth()->user()->hasRole('Super Administrador')) {
            $liquidacion = LiquidacionCC::orderBy('lcc_id')->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $cajaschicas = CajaChica::orderBy('cch_id')->whereIn('cch_empresa', $emp)->get()->pluck('cch_id');
            $liquidacion = LiquidacionCC::orderBy('lcc_id')->whereIn('lcc_cajachica', $cajaschicas)->get();
        }
        return view('cyb.cajas.autorizacion.index', compact ('liquidacion'));

    }

    public function masterdetalles($id)
    {
        $detalles = DetalleLiquidacionCC::where('dlcc_idcc', $id)->get();
        $nombre = LiquidacionCC::findOrFail($id);
        return view('cyb.cajas.autorizacion.masterdetalles', compact ('detalles', 'nombre'));
    }

    public function getContables(Request $request, $emp)
    {
        if ($request->ajax()) {
            $cta = CuentaContable::where('cta_empresa', $emp)->get();
            return response()->json($cta);
        } else {
            abort(404);
        }
    }

    public function empresa(){

        if (auth()->user()->hasRole('Super Administrador'))
        {

        }else
        {
            $emp = auth()->user()->Empresas->pluck('emp_id');
        }
    }




}
