<?php

namespace App\Http\Controllers\cxp;

use Exception;
use Carbon\Carbon;
use App\Models\cxp\Recibos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\cxp\PagosProveedores;
use App\Http\Requests\cxp\ValidacionRecibo;

class RecibosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('Super Administrador')) {
            $datas = Recibos::orderBy('rec_id')->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $ter = auth()->user()->Terminales->pluck('ter_id');
            $datas = Recibos::whereIn('rec_empresa', $emp)->whereIn('rec_terminal', $ter)->orderBy('rec_id')->get();
        }
        return view('cxp.recibos.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cxp.recibos.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionRecibo $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $fecha = Carbon::createFromFormat('d/m/Y', $request->rec_fecha);
                $request['rec_fecha'] = Carbon::parse($fecha)->format('Y-m-d H:i:s');
                $Corr = getCorrelativo($fecha, $request->rec_empresa, $request->rec_terminal, "G");
                $request->merge(['rec_correlativoInt' => $Corr->corr_id]);
                $request->merge(['correlativoTexto' => $Corr->corr_correlativo]);
                $poliza = Recibos::create($request->all());
            });
        } catch (Exception $e) {
            return redirect('cxp/recibos')->withErrors(['catch2', $e->errorInfo]);
        }
        return redirect('cxp/recibos')->with('mensajeHTML', "Póliza de Importación creada con el correlativo")->with('correlativo', $request->correlativoTexto);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Recibos::findOrFail($id);
        $pagos = PagosProveedores::where('pap_documento', $data->rec_id)->where('pap_tipoDoc','R')->get();
        return view('cxp.recibos.mostrar', compact('data', 'pagos'));
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
}
