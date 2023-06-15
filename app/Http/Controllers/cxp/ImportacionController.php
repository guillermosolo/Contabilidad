<?php

namespace App\Http\Controllers\cxp;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\cxp\Importacion;
use App\Models\cxp\DetallePoliza;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\cxp\PagosProveedores;
use App\Http\Requests\cxp\ValidacionImportacion;

class ImportacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('Super Administrador')) {
            $datas = Importacion::orderBy('poim_id')->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $ter = auth()->user()->Terminales->pluck('ter_id');
            $datas = Importacion::whereIn('poim_empresa', $emp)->whereIn('poim_terminal', $ter)->orderBy('poim_id')->get();
        }
        return view('cxp.importacion.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cxp.importacion.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionImportacion $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $fecha = Carbon::createFromFormat('d/m/Y', $request->poim_fecha);
                $request['poim_fecha'] = Carbon::parse($fecha)->format('Y-m-d H:i:s');
                $Corr =getCorrelativo($fecha,$request->poim_empresa,$request->poim_terminal,"G");
                $request->merge(['poim_correlativoInt' => $Corr->corr_id]);
                $request->merge(['correlativoTexto' => $Corr->corr_correlativo]);
                $poliza = Importacion::create($request->all());
               foreach ($request->detCantidad as $i => $item) {
                    $detalle = new DetallePoliza;
                    $detalle->detp_poliza = $poliza->poim_id;
                    $detalle->detp_cantidad = $request->detCantidad[$i];
                    $detalle->detp_descripcion = $request->detDescripcion[$i];
                    $detalle->detp_fob = $request->detfob[$i];
                    $detalle->detp_flete = $request->detflete[$i];
                    $detalle->detp_seguro = $request->detseguro[$i];
                    $detalle->detp_iva = $request->detiva[$i];
                    $detalle->detp_tipoGasto = $request->tipoGasto[$i];
                    $detalle->save();
                }
            });
            } catch (Exception $e) {
                return redirect('cxp/importacion')->withErrors(['catch2', $e->errorInfo]);
            }
            return redirect('cxp/importacion')->with('mensajeHTML', "Póliza de Importación creada con el correlativo")->with('correlativo', $request->correlativoTexto);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Importacion::findOrFail($id);
            $pagos = PagosProveedores::where('pap_documento', $data->poim_id)->where('pap_tipoDoc','I')->get();
            return view('cxp.importacion.mostrar', compact('data','pagos'));
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
