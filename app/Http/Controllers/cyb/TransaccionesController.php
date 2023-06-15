<?php

namespace App\Http\Controllers\cyb;

use App\Http\Controllers\Controller;
use App\Http\Requests\cyb\ValidacionExcelConciliacion;
use App\Http\Requests\cyb\ValidacionTransacciones;
use App\Imports\ConciliacionesImport;
use App\Models\cyb\Conciliaciones;
use App\Models\cyb\ConciliacionImport;
use App\Models\cyb\CuentasBancarias;
use App\Models\cyb\DetalleConciliacion;
use App\Models\cyb\Transacciones;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades;
use Maatwebsite\Excel\Facades\Excel;

class TransaccionesController extends Controller
{
    public function indexDeb()
    {
        if (auth()->user()->hasRole('Super Administrador'))
        {
            $transacciones = Transacciones::orderby('trab_id')->where('trab_tipo', 'MD')->get();
        }else
        {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $cuentas = CuentasBancarias::orderBy('ctab_id')->whereIn('ctab_empresa', $emp)->get()->pluck('ctab_id');
            $transacciones = Transacciones::orderby('trab_id')->where('trab_tipo', 'MD')->whereIn('trab_cuentabancaria', $cuentas)->get();
        }
        return view('cyb.bancos.conciliaciones.debitos.index', compact('transacciones'));
    }

    public function createdeb()
    {
        if (auth()->user()->hasRole('Super Administrador'))
        {
            $cuentasbancariass = CuentasBancarias::all();
        }else
        {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $cuentasbancariass = CuentasBancarias::orderBy('ctab_id')->whereIn('ctab_empresa', $emp)->get();
        }
        return view('cyb.bancos.conciliaciones.debitos.crear', compact('cuentasbancariass'));
    }

    public function storedeb(ValidacionTransacciones $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->validated();
                $data['trab_fecha'] = Carbon::parse(Carbon::createFromFormat('d/m/Y', $data['trab_fecha']))->format('Y-m-d H:i:s');
                $cuentabancaria = CuentasBancarias::findOrFail($data['trab_cuentabancaria']);
                if (!($request->terminal)) {
                    $data['terminal'] = 99;
                }
                $Corr = getCorrelativo($data['trab_fecha'], $cuentabancaria->ctab_empresa, $data['terminal'], 'C');
                $request->merge(['che_correlativoInt' => $Corr->corr_id]);
                $request->merge(['correlativoTexto' => $Corr->corr_correlativo]);
                $data['trab_correlativoInt'] = $Corr->corr_id;
                if (!($request->trab_conciliado)) {
                    $data['trab_conciliado'] = 0;
                }
                if (!($request->trab_tipo)) {
                    $data['trab_tipo'] = 'MD';
                }
                Transacciones::create($data);
            });
            return redirect()->route('debito')->with('mensajeHTML', 'Transaccion Generada con el correlativo: ')->with('correlativo', $request->correlativoTexto);
        } catch (Exception $e) {
            return redirect()->route('debito')->withErrors(['catch2', $e->errorInfo]);
        }
    }


    public function indexcre()
    {


        if (auth()->user()->hasRole('Super Administrador'))
        {
            $transacciones = Transacciones::orderby('trab_id')->where('trab_tipo', 'MD')->get();
        }else
        {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $cuentas = CuentasBancarias::orderBy('ctab_id')->whereIn('ctab_empresa', $emp)->get()->pluck('ctab_id');
            $transacciones = Transacciones::orderby('trab_id')->where('trab_tipo', 'MC')->whereIn('trab_cuentabancaria', $cuentas)->get();
        }
        return view('cyb.bancos.conciliaciones.creditos.index', compact('transacciones'));
    }

    public function createcre()
    {
        if (auth()->user()->hasRole('Super Administrador'))
        {
            $cuentasbancariass = CuentasBancarias::all();
        }else
        {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $cuentasbancariass = CuentasBancarias::orderBy('ctab_id')->whereIn('ctab_empresa', $emp)->get();
        }
        return view('cyb.bancos.conciliaciones.creditos.crear', compact('cuentasbancariass'));
    }

    public function storecre(ValidacionTransacciones $request)
    {
        try {

            DB::transaction(function () use ($request) {
                $data = $request->validated();
                $data['trab_fecha'] = Carbon::parse(Carbon::createFromFormat('d/m/Y', $data['trab_fecha']))->format('Y-m-d H:i:s');
                $cuentabancaria = CuentasBancarias::findOrFail($data['trab_cuentabancaria']);
                if (!($request->terminal)) {
                    $data['terminal'] = 99;
                }
                $Corr = getCorrelativo($data['trab_fecha'], $cuentabancaria->ctab_empresa, $data['terminal'], 'C');
                $request->merge(['che_correlativoInt' => $Corr->corr_id]);
                $request->merge(['correlativoTexto' => $Corr->corr_correlativo]);
                $data['trab_correlativoInt'] = $Corr->corr_id;
                if (!($request->trab_conciliado)) {
                    $data['trab_conciliado'] = 0;
                }
                if (!($request->trab_tipo)) {
                    $data['trab_tipo'] = 'MC';
                }
                Transacciones::create($data);
            });
            return redirect()->route('credito')->with('mensajeHTML', 'Transaccion generada con el correlativo: ')->with('correlativo', $request->correlativoTexto);
        } catch (Exception $e) {
            return redirect()->route('credito')->withErrors(['catch2', $e->errorInfo]);
        }
    }

    public function index()
    {
        $transacciones = Transacciones::orderby('trab_id')->get();
        return view('cyb.bancos.conciliaciones.conciliacion.index', compact('transacciones'));
    }

    public function createConcilacion($id)
    {
        $conciliacion = Conciliaciones::find($id);
        return view('cyb.bancos.conciliaciones.conciliacion.crear',compact('id', 'conciliacion'));
    }

    public function validarSinExcel($id)
    {
        $conciliacion = Conciliaciones::find($id);
        $transacciones = DB::table('detalleconciliacion as d')
            ->join('transaccionbancaria as t', 't.trab_id', '=', 'd.dcon_documento')
            ->join('cuentabancaria as c', 'c.ctab_id', '=', 't.trab_cuentabancaria')
            ->select('d.dcon_linea','t.trab_id', 'c.ctab_numero as cuenta_bancaria', 't.trab_fecha as fecha', 't.trab_documento as referencia', 't.trab_descripcion as concepto', 't.trab_monto as monto', 't.trab_tipo','d.dcon_conciliado')
            ->where('dcon_conciliacion', '=', $id)
            ->get();
        return view('cyb.bancos.conciliaciones.conciliacion.validarsinexcel', compact('transacciones', 'conciliacion'));
    }

    public function generarConciliacion(ValidacionExcelConciliacion $request,$id)
    {
        $excel = Excel::toCollection(new ConciliacionesImport, $request->excel)->first();

        $transacciones = DB::table('detalleconciliacion as d')
            ->join('transaccionbancaria as t', 't.trab_id', '=', 'd.dcon_documento')
            ->join('cuentabancaria as c', 'c.ctab_id', '=', 't.trab_cuentabancaria')
            ->select('d.dcon_linea','t.trab_id', 'c.ctab_numero as cuenta_bancaria', 't.trab_fecha as fecha', 't.trab_documento as referencia', 't.trab_descripcion as concepto', 't.trab_monto as monto')
            ->where('dcon_conciliacion', '=', $id)
            ->where('trab_conciliado', '=', false)
            ->orderby('trab_id')->get();

        $noValidado = collect();
        $validado = collect();
        $keysExcel = [];
        foreach ($transacciones as $keyT => $item) {
            foreach ($excel as $keyE => $ex) {
                if ($item->referencia == $ex['referencia']) {
                    if ($item->cuenta_bancaria == $ex['cuenta_bancaria'] && number_format($item->monto , 4, '.', '') == number_format($ex['monto'], 4, '.', '')) {
                        $validado->push($item);
                    } else {
                        $noValidado->push(['local' => $item, 'exterior' => $ex->toArray()]);
                    }
                    array_push($keysExcel, $keyE);
                    unset($transacciones[$keyT]);
                }
            }
        }
        foreach($keysExcel as $key){
            unset($excel[$key]);
        }

        $this->autorizarTransaccionesItems($validado);
        return view('cyb.bancos.conciliaciones.conciliacion.validar', compact('noValidado', 'transacciones','excel'));
    }

    private function autorizarTransaccionesItems($validado)
    {
        if ($validado) {
            foreach ($validado as $item) {
                $transaccion = Transacciones::find($item->trab_id);
                $transaccion->update(['trab_conciliado' => 1]);
                $detalle = DetalleConciliacion::find($item->dcon_linea);
                $detalle->update(['dcon_conciliado' => 1]);
            }
        }
    }
    public function autorizar(Request $request, $transaccion, $cambiar)
    {
        if ($request->ajax()) {
            [$id_tra,$id_detail] = explode('-',$transaccion);
            $tran = Transacciones::findorfail($id_tra);
            $det = DetalleConciliacion::find($id_detail);

            if ($cambiar==1) {
                $tran->update(['trab_conciliado' => 1]);
                $det->update(['dcon_conciliado' => 1]);

            } else {
                $tran->update(['trab_conciliado' => 0 ]);
                $det->update(['dcon_conciliado' => 0]);

            }
        } else {
            abort(404);
        }
    }
}
