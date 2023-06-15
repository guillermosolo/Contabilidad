<?php

namespace App\Http\Controllers\cyb;

use App\Http\Controllers\Controller;
use App\Http\Requests\cyb\ValidacionConciliaciones;
use App\Models\cyb\Conciliaciones;
use App\Models\cyb\CuentasBancarias;
use App\Models\cyb\DetalleConciliacion;
use App\Models\cyb\DetalleLiquidacionCC;
use App\Models\cyb\Transacciones;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConciliacionesController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('Super Administrador'))
        {
            $conciliacion = Conciliaciones::all();
        }else
        {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $cuentas = CuentasBancarias::whereIn('ctab_empresa', $emp)->get()->pluck('ctab_id');
            $conciliacion = Conciliaciones::orderBy('con_id')->whereIn('con_cuentabancaria', $cuentas)->get();
        }
        return view('cyb.bancos.conciliaciones.conciliacion.inicio', compact('conciliacion'));
    }

    public function create()
    {
        $idconciliacion = DB::table('Conciliacion')->where('con_conciliado', 0)->get('con_cuentabancaria');
        $cuentasbancarias = CuentasBancarias::where('ctab_id', 'NOT LIKE', '%' . $idconciliacion . '%')->get();
        return view('cyb.bancos.conciliaciones.conciliacion.generar', compact('cuentasbancarias'));
    }

    public function store(ValidacionConciliaciones $request)
    {
        $data = $request->validated();
        if (!($request->con_conciliado)) {
            $data['con_conciliado'] = 0;
        }
        $condicion = Conciliaciones::where('con_cuentabancaria', $data['con_cuentabancaria'])
            ->where('con_anio', $data['con_anio'])
            ->where('con_mes', $data['con_mes'])
            ->get();
        if($condicion->count()==0)
        {
        try {
            DB::transaction(function () use ($data) {
                $conciliacion = Conciliaciones::create($data);
                $transacciones = Transacciones::with('CuentadeBanco')
                    ->join('cuentabancaria as c', 'c.ctab_id', '=', 'trab_cuentabancaria')
                    ->where('trab_conciliado', '=', false)
                    ->where('c.ctab_id', '=', $conciliacion->con_cuentabancaria)->get();

                foreach ($transacciones as $transaccion) {
                    DetalleConciliacion::create(['dcon_conciliacion'=>$conciliacion->con_id,'dcon_documento'=>$transaccion->trab_id,'dcon_conciliado'=>0]);
                }
            });
        } catch (Exception $e) {
            return redirect()->route('conciliaciones')->withErrors(['catch2', $e->getMessage()]);
        }
        return redirect()->route('conciliaciones')->with('mensaje', 'Conciliacion creada con éxito.');
        }else{
            return redirect()->route('conciliaciones.crear')->withErrors(['Error en la Conciliacion', 'No puede ingresar una fecha Repetida.']);
        }

    }

    public function getCuenta(Request $request, $id)
    {
        if ($request->ajax()) {
            $idconciliacion = DB::table('Conciliacion')->where('con_conciliado', 0)->get('con_cuentabancaria');
            $cuentas = DB::table('cuentabancaria as c')->where('c.ctab_empresa', '=', $id)->where('c.ctab_id', 'NOT LIKE', '%' . $idconciliacion . '%')
                ->join('empresa as e', 'e.emp_id', '=', 'c.ctab_empresa')
                ->join('bancos as b', 'b.ban_id', '=', 'c.ctab_banco')
                ->join('moneda as m', 'm.mon_id', '=', 'c.ctab_moneda')
                ->select('c.*', 'e.emp_siglas', 'b.ban_siglas', 'm.mon_nombre')->get();
            return response()->json($cuentas);
        } else {
            abort(404);
        }
    }

    public function ConciConciliar(Request $request, $conciliacion, $cambiar)
    {
        if ($request->ajax()) {
            $conci = Conciliaciones::findorfail($conciliacion);

            if ($cambiar == 'conciliado') {
                $conci->update(['con_conciliado' => 1]);
            } else {
                $conci->update(['con_conciliado' => 0]);        }
        } else {
            abort(404);
        }
    }

    public function DetallesConciliacion($id)
    {
        $transacciones = DB::table('detalleconciliacion as d')
            ->join('transaccionbancaria as t', 't.trab_id', '=', 'd.dcon_documento')
            ->join('cuentabancaria as c', 'c.ctab_id', '=', 't.trab_cuentabancaria')
            ->select('d.dcon_linea','t.trab_id', 'c.ctab_numero as cuenta_bancaria', 't.trab_fecha as fecha', 't.trab_documento as referencia', 't.trab_descripcion as concepto', 't.trab_monto as monto', 't.trab_tipo','d.dcon_conciliado')
            ->where('dcon_conciliacion', '=', $id)
            ->orderby('trab_id')->get();
        return view('cyb.bancos.conciliaciones.conciliacion.listadetalles', compact('transacciones'));
    }
}
