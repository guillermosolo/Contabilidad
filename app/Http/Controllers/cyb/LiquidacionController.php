<?php

namespace App\Http\Controllers\cyb;

use App\Http\Controllers\Controller;
use App\Http\Requests\cyb\ValidacionDetalleLiquidacionCC;
use App\Http\Requests\cyb\ValidacionLiquidacionCC;
use App\Models\Admin\TipoCombustible;
use App\Models\Contabilidad\CuentaContable;
use App\Http\Requests\Parametros\ValidacionTerminal;
use App\Models\cxp\Proveedor;
use App\Models\cyb\CajaChica;
use App\Models\cyb\Cheque;
use App\Models\cyb\CuentasBancarias;
use App\Models\cyb\DetalleLiquidacionCC;
use App\Models\cyb\LiquidacionCC;
use App\Models\cyb\Operacion;
use App\Models\cyb\Transacciones;
use App\Models\Parametros\Empresa;
use App\Models\Parametros\Terminal;
use App\Models\Planilla\Empleado;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LiquidacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->user()->hasRole('Super Administrador')) {
            $liquidacion = LiquidacionCC::orderBy('lcc_id')->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $cajaschicas = CajaChica::whereIn('cch_empresa', $emp)->get()->pluck('cch_id');
            $liquidacion = LiquidacionCC::orderBy('lcc_id')->whereIn('lcc_cajachica', $cajaschicas)->get();
        }
        $buscar = $request->get('buscar');

        return view('cyb.cajas.liquidaciones.index', compact('liquidacion', 'buscar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $liquidacion = LiquidacionCC::orderby('lcc_id')->where('lcc_pendiente', 0)->get()->pluck('lcc_id');
        if (auth()->user()->hasRole('Super Administrador')) {
            $cajaschicas = CajaChica::whereNotIn('cch_id', $liquidacion)->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $cajaschicas = CajaChica::whereNotIn('cch_id', $liquidacion)->whereIn('cch_empresa', $emp)->get();
        }
        return view('cyb.cajas.liquidaciones.liquidar', compact('cajaschicas'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionLiquidacionCC $request)
    {
        $data = $request->validated();
        $data['lcc_fecha'] = Carbon::parse(Carbon::createFromFormat('d/m/Y', $data['lcc_fecha']))->format('Y-m-d H:i:s');
        LiquidacionCC::create($data);
        return redirect()->route('liquidacion')->with('mensaje', 'Liquidación creada con éxito.');

    }

    public function show($id)
    {
        $liquidacioness = LiquidacionCC::find($id);
        $cajachica = CajaChica::findOrFail($liquidacioness['lcc_cajachica']);
        $proveedores = Proveedor::all();
        $empresas = Empresa::where('emp_id', $cajachica['cch_empresa'])->first();
        $terminales = Terminal::all();
        $combustible = TipoCombustible::all();
        $cuentascontables = CuentaContable::orderby('cta_id')->where('cta_id', '<', 10)->get();
        $cuentasbancarias = CuentasBancarias::orderby('ctab_id')->get();
        $detalles = DetalleLiquidacionCC::where('dlcc_idcc', $id)->orderBy('dlcc_id', 'DESC')->take(3)->get();
        return view('cyb.cajas.liquidaciones.detalle', compact('liquidacioness', 'proveedores', 'terminales', 'cuentascontables', 'empresas', 'cuentasbancarias', 'combustible', 'detalles'));
    }


    public function storedetalle(ValidacionDetalleLiquidacionCC $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->validated();
                $data['dlcc_fecha'] = Carbon::parse(Carbon::createFromFormat('d/m/Y', $data['dlcc_fecha']))->format('Y-m-d H:i:s');
                $data['dlcc_correlativoInt'] = getCorrelativo($data['dlcc_fecha'], $data['dlcc_empresa'], $data['dlcc_terminal'], 'D')->corr_id;
                if (!($request->dlcc_status)) {
                    $data['dlcc_status'] = 'P';
                }
                DetalleLiquidacionCC::create($data);
            });
            return redirect()->back()->with('mensaje', 'Registro generado con éxito.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['catch', $e->getMessage()]);
        }
    }


    public function indexdetalle($id)
    {
        $detalles = DetalleLiquidacionCC::where('dlcc_idcc', $id)->get();
        $nombre = LiquidacionCC::findOrFail($id);
        return view('cyb.cajas.liquidaciones.listadetalle', compact('detalles', 'nombre'));

    }

    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        try {
            $liquidacion = LiquidacionCC::find($id);
            $liquidacion->delete();
            return redirect()->route('liquidacion')->with(["mensaje" => "Registro eliminado con éxito"]);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('liquidacion')->withErrors(['catch', $e->errorInfo]);
        }
    }
//Es esta
    public function cambiarestatus(Request $request, $detalle, $cambiar)
    {
        if ($request->ajax()) {
            $detalle = DetalleLiquidacionCC::findorfail($detalle);
            if ($cambiar == 'liquidar') {
                $detalle->update(['dlcc_status' => 'L']);
            }
            if ($cambiar == 'pendiente') {
                $detalle->update(['dlcc_status' => 'P']);
            }
            if ($cambiar == 'rechazar') {
                $detalle->update(['dlcc_status' => 'R']);
            }
        } else {
            abort(404);
        }
    }

    public function autorizar(Request $request, $autorizacion, $cambiar)
    {
        if ($request->ajax()) {
            $autorizacion = DetalleLiquidacionCC::findorfail($autorizacion);
            if ($cambiar == 'liquidado') {
                $autorizacion->update(['dlcc_status' => 'L']);
            }else{
                $autorizacion->update(['dlcc_status' => 'P']);
            }
        } else {
            abort(404);
        }
    }

    public function rechazar(Request $request, $rechazo, $cambiar2)
    {
        if ($request->ajax()) {
            $rechazo = DetalleLiquidacionCC::findorfail($rechazo);
            if ($cambiar2 == 'rechazado') {
                $rechazo->update(['dlcc_status' => 'R']);
            }else{
                $rechazo->update(['dlcc_status' => 'P']);
            }
        } else {
            abort(404);
        }
    }

    public function liquidar(Request $request, $liquidacion, $cambiar)
    {
        if ($request->ajax()) {
            $liquidacion = LiquidacionCC::findorfail($liquidacion);
            if ($cambiar == 'liquidar') {
                $liquidacion->update(['lcc_pendiente' => 1]);
                $detalles = DetalleLiquidacionCC::where('dlcc_idcc',$liquidacion->lcc_id)->get();
                foreach ($detalles as $detalle) {
                    if ($detalle->dlcc_status == 'P'){
                        $detalle->update(['dlcc_status' =>  'R']);
                    }
                }
            } else {
                $liquidacion->update(['lcc_pendiente' => 0 ]);
            }

        } else {
            abort(404);
        }
    }
}


