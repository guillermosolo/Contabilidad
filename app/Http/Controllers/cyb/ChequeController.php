<?php

namespace App\Http\Controllers\cyb;

use App\Http\Controllers\Controller;
use App\Http\Requests\cyb\ValidacionCheque;
use App\Http\Requests\cyb\ValidacionTransacciones;
use App\Models\Admin\Bancos;
use App\Models\Admin\CorrelativoInterno;
use App\Models\Admin\Moneda;
use App\Models\cyb\Cheque;
use App\Models\cyb\CuentasBancarias;
use App\Models\cyb\Transacciones;
use App\Models\Parametros\Empresa;
use App\Models\Parametros\Terminal;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Traits\GetIdByNameTrait;

class ChequeController extends Controller
{

//*********************TRANSFERENCIAS A TERCEROS ***************************
    public function indexater()
    {
        if (auth()->user()->hasRole('Super Administrador'))
        {
            $aterceros = Cheque::where('che_tipo', 'CA')->orwhere('che_tipo', 'TA')->get();
        }else
        {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $cuentas = CuentasBancarias::orderBy('ctab_id')->whereIn('ctab_empresa', $emp)->get()->pluck('ctab_id');
            $aterceros = Cheque::orderBy('che_id')->whereIn('che_cuentabancaria', $cuentas)->where('che_tipo', 'CA')->orwhere('che_tipo', 'TA')->get();
        }

        return view('cyb.bancos.transferencias.terceros.index', compact('aterceros'));
    }

    public function createAter()
    {
        if (auth()->user()->hasRole('Super Administrador')) {
            $cuentasbancariass = CuentasBancarias::all();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $cuentasbancariass = CuentasBancarias::whereIn('ctab_empresa', $emp)->get();
        }
        return view('cyb.bancos.transferencias.terceros.crear', compact('cuentasbancariass'));
    }

    public function storeAter(ValidacionCheque $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->validated();
                $data['che_fecha'] = Carbon::parse(Carbon::createFromFormat('d/m/Y', $data['che_fecha']))->format('Y-m-d H:i:s');
                $cuentabancaria = CuentasBancarias::findOrFail($data['che_cuentabancaria']);
                if(!($request->che_terminal)){
                    $data['che_terminal']= 99;
                }
                $Corr =getCorrelativo($data['che_fecha'], $cuentabancaria->ctab_empresa, $data['che_terminal'], 'D' );
                $request->merge(['che_correlativoInt' => $Corr->corr_id]);
                $request->merge(['correlativoTexto' => $Corr->corr_correlativo]);
                $data['che_correlativoInt'] = $Corr->corr_id;
                if(!($request->che_tc)){
                    $data['che_tc']= 1;
                }
                if($request->che_tipo=='CA'){
                    $tipo = 'CA';
                }else{
                    $tipo = 'TA';
                }
                if(!($request->che_negociable)){
                    $data['che_negociable']= 0;
                }
                Cheque::create($data);
                Transacciones::create([
                    'trab_cuentabancaria'=>$data['che_cuentabancaria'],
                    'trab_fecha'=>$data['che_fecha'],
                    'trab_documento'=>$data['che_numero'],
                    'trab_tipo'=>$tipo,
                    'trab_descripcion'=>$data['che_descripcion'],
                    'trab_monto'=>$data['che_monto'],
                    'trab_conciliado'=>0,
                    'trab_correlativoInt'=>$data['che_correlativoInt']]);
            });
            return redirect()->route('chequeater')->with('mensajeHTML', 'Cheque o Transferencia Generada con el correlativo: ')->with('correlativo', $request->correlativoTexto);
        } catch (Exception $e) {
            return redirect()->route('chequeater')->withErrors(['catch', $e->errorInfo]);
        }

    }

    public function editAter($id)
    {
        $aterceros = Cheque::find($id);
        $cuentasbancariass = CuentasBancarias::all();
        return view('cyb.bancos.transferencias.terceros.editar', compact('aterceros', 'cuentasbancariass'));
    }


//*********************TRANSFERENCIAS A TERCEROS ***************************
    public function indexdeter()
    {
        if (auth()->user()->hasRole('Super Administrador'))
        {
            $deterceros = Transacciones::where('trab_tipo', 'DE')->orWhere('trab_tipo', 'TD')->get();
        }else
        {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $cuentas = CuentasBancarias::orderBy('ctab_id')->whereIn('ctab_empresa', $emp)->get()->pluck('ctab_id');
            $deterceros = Transacciones::where('trab_tipo', 'DE')->orWhere('trab_tipo', 'TD')->whereIn('trab_cuentabancaria', $cuentas)->get();
        }
        return view('cyb.bancos.transferencias.deterceros.index', compact('deterceros'));
    }

    public function createdeter()
    {
        if (auth()->user()->hasRole('Super Administrador')) {
            $cuentasbancariass = CuentasBancarias::all();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $cuentasbancariass = CuentasBancarias::whereIn('ctab_empresa', $emp)->get();
        }
        return view('cyb.bancos.transferencias.deterceros.crear', compact('cuentasbancariass'));
    }

    public function storedeter(ValidacionTransacciones $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->validated();
                $data['trab_fecha'] = Carbon::parse(Carbon::createFromFormat('d/m/Y', $data['trab_fecha']))->format('Y-m-d H:i:s');
                $cuentabancaria = CuentasBancarias::findOrFail($data['trab_cuentabancaria']);
                if(!($request->terminal)){
                    $data['terminal']= 99;
                }
                $data['trab_correlativoInt']=getCorrelativo($data['trab_fecha'], $cuentabancaria->ctab_empresa, $data['terminal'], 'C' );
                $Corr = $data['trab_correlativoInt'];
                $request->merge(['trab_correlativoInt' => $Corr->corr_id]);
                $request->merge(['correlativoTexto' => $Corr->corr_correlativo]);
                if(!($request->trab_conciliado)){
                    $data['trab_conciliado']= 0;
                }
                $data['trab_correlativoInt'] = $Corr->corr_id;
                Transacciones::create($data);
            });
            return redirect()->route('chequedeter')->with('mensajeHTML', 'Transferencia Generada con el correlativo: ')->with('correlativo', $request->correlativoTexto);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('chequedeter')->withErrors(['catch2', $e->errorInfo]);
        }
    }

//*********************TRANSFERENCIAS A RELACIONADOS***************************
    public function indexrel()
    {
        if (auth()->user()->hasRole('Super Administrador'))
        {
            $internas = Cheque::where('che_tipo', 'TR')->get();
        }else
        {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $cuentas = CuentasBancarias::orderBy('ctab_id')->whereIn('ctab_empresa', $emp)->get()->pluck('ctab_id');
            $internas = Cheque::where('che_tipo', 'TR')->whereIn('che_cuentabancaria', $cuentas)->get();
        }

        return view('cyb.bancos.transferencias.interrelacionadas.index', compact('internas'));
    }

    public function indexderel()
    {
        if (auth()->user()->hasRole('Super Administrador'))
        {
            $trans = Transacciones::where('trab_tipo', 'DR')->get();
        }else
        {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $cuentas = CuentasBancarias::orderBy('ctab_id')->whereIn('ctab_empresa', $emp)->get()->pluck('ctab_id');
            $trans = Transacciones::where('trab_tipo', 'DR')->whereIn('trab_cuentabancaria', $cuentas)->get();
        }
        return view('cyb.bancos.transferencias.interrelacionadas.indexde', compact('trans'));
    }

    public function relacion()
    {
        $cuentasbancariass = CuentasBancarias::all();
        $empresas = Empresa::orderBy('emp_id')->where('emp_id', '>', 0 )->get();
        return view('cyb.bancos.transferencias.interrelacionadas.crear', compact('cuentasbancariass', 'empresas'));
    }

    public function storerelacion(ValidacionCheque $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->validated();
                $empresa = Empresa::findOrFail($data['empresaacreditar']);
                $data['che_fecha'] = Carbon::parse(Carbon::createFromFormat('d/m/Y', $data['che_fecha']))->format('Y-m-d H:i:s');
                $cuentabancaria = CuentasBancarias::findOrFail($data['che_cuentabancaria']);
                if(!($request->che_terminal)){
                    $data['che_terminal']= 99;
                }
                $Corr = getCorrelativo($data['che_fecha'], $cuentabancaria->ctab_empresa, $data['che_terminal'], 'D' );
                $request->merge(['che_correlativoInt' => $Corr->corr_id]);
                $request->merge(['correlativoTexto' => $Corr->corr_correlativo]);
                $data['che_correlativoInt'] = $Corr->corr_id;
                if(!($request->che_tc)){
                    $data['che_tc']=1;
                }
                if(!($request->che_negociable)){
                    $data['che_negociable']= 0;
                }
                if(!($request->che_beneficiario)){
                $data['che_beneficiario']= $empresa->emp_siglas;
                }
                Cheque::create($data);
                Transacciones::create([
                    'trab_cuentabancaria'=>$data['che_cuentabancaria'],
                    'trab_fecha'=>$data['che_fecha'],
                    'trab_documento'=>$data['che_numero'],
                    'trab_tipo'=>$data['che_tipo'],
                    'trab_descripcion'=>$data['che_descripcion'],
                    'trab_monto'=>$data['che_monto'],
                    'trab_conciliado'=>0,
                    'trab_correlativoInt'=>$data['che_correlativoInt']]);
            });

            return redirect()->route('relacionadas')->with('mensajeHTML', 'Transferencia generada con el correlativo: ')->with('correlativo', $request->correlativoTexto);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('relacionadas')->withErrors(['catch', $e->errorInfo]);
        }
        return view('cyb.bancos.transferencias.internas.crear');
    }

    public function derelacion()
    {
        $cuentasbancariass = CuentasBancarias::all();
        $empresas = Empresa::orderBy('emp_id')->where('emp_id', '>', 0 )->get();
        return view('cyb.bancos.transferencias.interrelacionadas.crearde', compact('cuentasbancariass', 'empresas'));
    }

    public function storederel(ValidacionTransacciones $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->validated();
                $empresa = Empresa::findOrFail($data['empresa']);
                $data['trab_fecha'] = Carbon::parse(Carbon::createFromFormat('d/m/Y', $data['trab_fecha']))->format('Y-m-d H:i:s');
                $cuentabancaria = CuentasBancarias::findOrFail($data['trab_cuentabancaria']);
                if(!($request->terminal)){
                    $data['terminal']= 99;
                }
                $Corr =getCorrelativo($data['trab_fecha'], $cuentabancaria->ctab_empresa, $data['terminal'], 'C' );
                $request->merge(['trab_correlativoInt' => $Corr->corr_id]);
                $request->merge(['correlativoTexto' => $Corr->corr_correlativo]);
                $data['trab_correlativoInt'] = $Corr->corr_id;
                if(!($request->trab_conciliado)){
                    $data['trab_conciliado']= 0;
                }
                if(!($request->trab_descripcion))
                {
                    $data['trab_descripcion']= 'Debito a ' .$empresa->emp_siglas ;
                }else{
                    $data['trab_descripcion']= $data['trab_descripcion']. ' - Debito a ' . $empresa->emp_siglas ;
                }
                Transacciones::create($data);
            });
            return redirect()->route('derelacionadas')->with('mensajeHTML', 'Transferencia generada con el correlativo: ')->with('correlativo', $request->correlativoTexto);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('derelacionadas')->withErrors(['catch2', $e->errorInfo]);
        }
    }

//*********************TRANSFERENCIAS INTERNAS ***************************
    public function indexinter()
    {
        if (auth()->user()->hasRole('Super Administrador'))
        {
            $internas = Cheque::where('che_tipo', 'TI')->get();
        }else
        {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $cuentas = CuentasBancarias::orderBy('ctab_id')->whereIn('ctab_empresa', $emp)->get()->pluck('ctab_id');
            $internas = Cheque::orderBy('che_id')->whereIn('che_cuentabancaria', $cuentas)->where('che_tipo', 'TI')->get();
        }
        return view('cyb.bancos.transferencias.internas.index', compact('internas'));
    }

    public function internas()
    {
        $cuentasbancariass = CuentasBancarias::all();
        return view('cyb.bancos.transferencias.internas.crear', compact('cuentasbancariass'));
    }

    public function createinter(ValidacionCheque $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->validated();
                $data2= $request->validated();
                $data['che_fecha'] = Carbon::parse(Carbon::createFromFormat('d/m/Y', $data['che_fecha']))->format('Y-m-d H:i:s');
                $cuentabancaria = CuentasBancarias::findOrFail($data['che_cuentabancaria']);
                $cuentabancaria2 = CuentasBancarias::findOrFail($data['che_cuentabancaria2']);
                if(!($request->che_terminal)){
                    $data['che_terminal']= 99;
                }
                if(!($request->che_terminal2)){
                    $data['che_terminal2']= 99;
                }
                $Corr =getCorrelativo($data['che_fecha'], $cuentabancaria->ctab_empresa, $data['che_terminal'], 'D' );
                $request->merge(['trab_correlativoInt' => $Corr->corr_id]);
                $request->merge(['correlativoTexto' => $Corr->corr_correlativo]);
                $data['che_correlativoInt'] = $Corr->corr_id;
                $data2['che_correlativoInt']=getCorrelativo($data['che_fecha'], $cuentabancaria2->ctab_empresa, $data['che_terminal2'], 'C' )->corr_id;
                if(!($request->che_tc)){
                    $data['che_tc']=1;
                }
                if(!($request->che_negociable)){
                    $data['che_negociable']= 0;
                }
                $empresa= Empresa::findOrFail($cuentabancaria2->ctab_empresa);
                if(!($request->che_beneficiario)){
                    $data['che_beneficiario']= $empresa->emp_siglas;
                }
                Cheque::create($data);
                Transacciones::create([
                    'trab_cuentabancaria'=>$data['che_cuentabancaria'],
                    'trab_fecha'=>$data['che_fecha'],
                    'trab_documento'=>$data['che_numero'],
                    'trab_tipo'=>$data['che_tipo'],
                    'trab_descripcion'=>$data['che_descripcion'],
                    'trab_monto'=>$data['che_monto'],
                    'trab_conciliado'=>0,
                    'trab_correlativoInt'=>$data['che_correlativoInt']]);
                Transacciones::create([
                    'trab_cuentabancaria'=>$data['che_cuentabancaria2'],
                    'trab_fecha'=>$data['che_fecha'],
                    'trab_documento'=>$data['che_numero2'],
                    'trab_tipo'=>$data['che_tipo'],
                    'trab_descripcion'=>$data['che_descripcion'],
                    'trab_monto'=>$data['che_monto'],
                    'trab_conciliado'=>0,
                    'trab_correlativoInt'=>$data2['che_correlativoInt']]);
            });

            return redirect()->route('internas')->with('mensajeHTML', 'Cheque generado con el correlativo: ')->with('correlativo', $request->correlativoTexto);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('internas')->withErrors(['catch2', $e->errorInfo]);
        }
        return view('cyb.bancos.transferencias.internas.crear');
    }

    public function getCuenta(Request $request, $id)
    {
        if ($request->ajax()) {
            $cuentas= DB::table('cuentabancaria as c')->where('c.ctab_empresa', '=', $id)->join('empresa as e','e.emp_id','=','c.ctab_empresa')
                ->join('bancos as b','b.ban_id','=','c.ctab_banco')
                ->join('moneda as m','m.mon_id','=','c.ctab_moneda')
                ->select('c.*','e.emp_siglas', 'b.ban_siglas', 'm.mon_nombre')->get();
            return response()->json($cuentas);
        } else {
            abort(404);
        }
    }

    public function destroyCHTB($id)
    {
        try {
            $cheque= Cheque::find($id);
            $tran = Transacciones::where('trab_documento', $cheque['che_numero'])->get('trab_id');
            $newid = $tran->map(function ($tran) {
                return array($tran, ['trab_id']);
            });
            $transaccion = Transacciones::find($newid);
            dd($newid);
            return redirect()->route('chequeater')->with(["mensaje"=>"Registros eliminado con éxito"]);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('chequeater')->withErrors(['catch', $e->errorInfo]);
        }
    }
}
