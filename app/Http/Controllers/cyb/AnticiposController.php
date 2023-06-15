<?php

namespace App\Http\Controllers\cyb;
use App\Http\Controllers\Controller;
use App\Http\Requests\cyb\ValidacionAnticipo;
use App\Http\Requests\cyb\ValidacionCheque;
use App\Http\Requests\cyb\ValidacionDetalleAnticipo;
use App\Models\Admin\CorrelativoInterno;
use App\Models\Admin\MovimientoBancario;
use App\Models\Admin\Persona;
use App\Models\cxp\Proveedor;
use App\Models\cyb\Anticipos;
use App\Models\cyb\Cheque;
use App\Models\cyb\CuentasBancarias;
use App\Models\cyb\DetalleAnticipo;
use App\Models\cyb\Transacciones;
use App\Models\Parametros\Empresa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;

class AnticiposController extends Controller
{

    public function index(Request $request)
    {

        if (auth()->user()->hasRole('Super Administrador'))
        {
            $anticipos = Anticipos::orderBy('ant_id')->get();
        }else
        {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $terAuth = auth()->user()->Terminales->pluck('ter_id');
            $cuentas = CuentasBancarias::orderBy('ctab_id')->whereIn('ctab_empresa', $emp)->get()->pluck('ctab_id');
            $corr = CorrelativoInterno::whereIn('corr_terminal', $terAuth)->get()->pluck('corr_id');
            $cheque = Cheque::orderBy('che_id')->whereIn('che_cuentabancaria', $cuentas)->whereIn('che_correlativoInt', $corr)->get()->pluck('che_id');
            $anticipos = Anticipos::orderBy('ant_id')->whereIn('ant_cheque', $cheque)->get();
        }
        $buscar = $request->get('buscar');
        return view('cyb.bancos.anticipos.anticipo.index', compact('anticipos', 'buscar'));
    }


    public function create()
    {
        if (auth()->user()->hasRole('Super Administrador')) {
            $cuentasbancariass = CuentasBancarias::all();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $cuentasbancariass = CuentasBancarias::whereIn('ctab_empresa', $emp)->get();
        }
        $proveedores = Proveedor::all();
        return view('cyb.bancos.anticipos.anticipo.crear', compact('cuentasbancariass', 'proveedores'));
    }


    public function store(ValidacionCheque $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->validated();
                $data['che_fecha'] = Carbon::parse(Carbon::createFromFormat('d/m/Y', $data['che_fecha']))->format('Y-m-d H:i:s');
                $cuentabancaria = CuentasBancarias::findOrFail($data['che_cuentabancaria']);
                $Corr =getCorrelativo($data['che_fecha'], $cuentabancaria->ctab_empresa, $data['che_terminal'], 'D' );
                $request->merge(['che_correlativoInt' => $Corr->corr_id]);
                $request->merge(['correlativoTexto' => $Corr->corr_correlativo]);
                $data['che_correlativoInt'] = $Corr->corr_id;
                $beneficiarioanticipo = $data['che_beneficiario'];
                if(!($request->che_conciliado)){
                    $data['che_conciliado']= 0;
                }
                if(!($request->che_tipo)){
                    $data['che_tipo']= 'CH';
                }
                if(!($request->che_negociable)){
                    $data['che_negociable']= 0;
                }
                if(!($request->che_tc)){
                    $data['che_tc']= 1;
                }
                if(($request->che_beneficiario)==0){
                    $data['che_beneficiario']= $data['beneficiario'];
                }else{
                    $proveedor = Proveedor::find($data['che_beneficiario']);
                    $beneficiario = Persona::find($proveedor['pro_persona']);
                    $data['che_beneficiario']= $beneficiario['per_nombre'];
                }
                $cheque = Cheque::create($data);
                if($cheque['che_beneficiario']== $data['beneficiario']){
                    $cheque['che_beneficiario']= null;
                }else{
                    $cheque['che_beneficiario']= $beneficiarioanticipo;
                }
                Anticipos::create([
                    'ant_numero' => $cuentabancaria['ctab_numero'] .'-'. $data['che_numero'],
                    'ant_fecha' => $cheque['che_fecha'],
                    'ant_liquidado' => 0,
                    'ant_cheque' => $cheque['che_id'],
                    'ant_proveedor' => $cheque['che_beneficiario'],
                ]);
                Transacciones::create([
                    'trab_cuentabancaria'=> $cheque['che_cuentabancaria'],
                    'trab_fecha'=> $cheque['che_fecha'],
                    'trab_documento'=> $cheque['che_numero'],
                    'trab_tipo'=> $cheque['che_tipo'],
                    'trab_descripcion'=> $cheque['che_descripcion'],
                    'trab_monto'=> $cheque['che_monto'],
                    'trab_conciliado'=> 0,
                    'trab_correlativoInt'=> $cheque['che_correlativoInt']
                ]);
            });
            return redirect()->route('anticipos')->with('mensajeHTML', 'Cheque Generado con el correlativo: ')->with('correlativo', $request->correlativoTexto);
        } catch (Exception $e) {
            return redirect()->route('anticipos')->withErrors(['mensaje', 'Error generando el Registro.']);
        }
    }


    public function show(Request $request)
    {
        if (auth()->user()->hasRole('Super Administrador'))
        {
            $anticipos = Anticipos::orderBy('ant_id')->get();
        }else
        {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $terAuth = auth()->user()->Terminales->pluck('ter_id');
            $cuentas = CuentasBancarias::orderBy('ctab_id')->whereIn('ctab_empresa', $emp)->get()->pluck('ctab_id');
            $corr = CorrelativoInterno::whereIn('corr_terminal', $terAuth)->get()->pluck('corr_id');
            $cheque = Cheque::orderBy('che_id')->whereIn('che_cuentabancaria', $cuentas)->whereIn('che_correlativoInt', $corr)->get()->pluck('che_id');
            $anticipos = Anticipos::orderBy('ant_id')->whereIn('ant_cheque', $cheque)->get();
        }
        $buscar = $request->get('buscar');
        return view('cyb.bancos.anticipos.liquidar.index', compact('anticipos', 'buscar'));
    }

    public function masterdetalles($id)
    {
        $detalles = DetalleAnticipo::where('dant_anticipo', $id)->get();
        $nombre = Anticipos::findOrFail($id);
        return view('cyb.bancos.anticipos.liquidar.masterdetalles', compact('detalles', 'nombre'));
    }


    public function antdetalle($id)
    {
        $anticipos = Anticipos::find($id);
        $movimientos = MovimientoBancario::all();
        return view('cyb.bancos.anticipos.anticipo.creardetalle', compact('anticipos', 'movimientos'));
    }

    public function storedetalle(ValidacionDetalleAnticipo $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->validated();
                if(!($request->dant_estado)){
                    $data['dant_estado']= 'P';
                }
                DetalleAnticipo::create($data);
            });
            return redirect()->route('anticipos')->with('mensaje', 'Registro generado con éxito.');
        } catch (Exception $e) {
            return redirect()->route('anticipos')->withErrors(['catch2', $e->errorInfo]);
        }
    }

    public function listadetalle($id)
    {
        $detalles = DetalleAnticipo::where('dant_anticipo', $id)->get();
        $nombre = Anticipos::findOrFail($id);
        return view('cyb.bancos.anticipos.anticipo.listadetalle', compact('detalles', 'nombre'));
    }

    public function liquiddetalles(Request $request, $detalles, $cambiar)
    {
        if ($request->ajax()) {
            $detalles = DetalleAnticipo::findorfail($detalles);
            if ($cambiar == 'liquidado') {
                $detalles->update(['lcc_pendiente' => 1]);
            } else {
                $detalles->update(['lcc_pendiente' => 0 ]);
            }
        } else {
            abort(404);
        }
    }

    public function detalleEstado(Request $request, $detalle, $cambiar)
    {
        if ($request->ajax()) {
            $detalle = DetalleAnticipo::findorfail($detalle);
            if ($cambiar == 'liquidado') {
                $detalle->update(['dant_estado' => 'L']);
            } else {
                $detalle->update(['dant_estado' => 'R']);
            }
        } else {
            abort(404);
        }
    }


    public function antLiquidar(Request $request, $liquidacion, $cambiar)
    {
        if ($request->ajax()) {
            $anticipo = Anticipos::findorfail($liquidacion);

            if ($cambiar == 'liquidado') {
                $anticipo->update(['ant_liquidado' => 1]);
                $detalles = DetalleAnticipo::where('dant_anticipo', $liquidacion)->get();
                foreach ($detalles as $detalle) {
                    if ($detalle->dant_estado == 'P'){
                        $detalle->update(['dant_estado' =>  'R']);
                    }
                }
            } else {
                $anticipo->update(['ant_liquidado' => 0 ]);
            }
        } else {
            abort(404);
        }
    }
}
