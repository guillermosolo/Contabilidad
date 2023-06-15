<?php

namespace App\Http\Controllers\Parametros;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Seguridad\Usuario;
use App\Models\Parametros\Empresa;
use App\Models\Admin\Representante;
use App\Models\Parametros\Terminal;
use App\Http\Controllers\Controller;
use App\Models\Admin\Representacion;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\TiposRepresentante;
use App\Http\Requests\Parametros\ValidacionEmpresa;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('Super Administrador')) {
            $datas = Empresa::where('emp_id', '>', 0)->orderBy('emp_id')->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $datas = auth()->user()->Empresas;
        }
        return view('parametros.empresa.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parametros.empresa.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionEmpresa $request)
    {dd($request->all());
        if (!($request->emp_activa)) {
            $request->merge(['emp_activa' => '0']);
        }
        if (!($request->emp_sindicato)) {
            $request->merge(['emp_sindicato' => '0']);
        }
        $fecha = Carbon::createFromFormat('d/m/Y', $request->emp_inicio);
        $request['emp_inicio'] = Carbon::parse($fecha)->format('Y-m-d H:i:s');
        $ultimo = Empresa::max('emp_id');
        $ultimo += 1;
        $request->merge(['emp_id' => $ultimo]);
        Empresa::create($request->all());
        if ($request->emp_logo) {
            //obtenemos el campo file definido en el formulario
            $file = $request->file('emp_logo');
            //obtenemos el nombre del archivo
            $nombre = $ultimo . ".jpg";
            //indicamos que queremos guardar un nuevo archivo en el disco local
            Storage::disk('logos')->put($nombre,  File::get($file));
        }

        return redirect('parametros/empresa')->with('mensaje', 'Empresa creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Empresa::findOrFail($id);
        return view('parametros.empresa.mostrar', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Empresa::findOrFail($id);
        return view('parametros.empresa.editar', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionEmpresa $request, $id)
    {
        if (!($request->emp_activa)) {
            $request->merge(['emp_activa' => '0']);
        }
        if (!($request->emp_sindicato)) {
            $request->merge(['emp_sindicato' => '0']);
        }
        $fecha = Carbon::createFromFormat('d/m/Y', $request->emp_inicio);
        $request['emp_inicio'] = Carbon::parse($fecha)->format('Y-m-d H:i:s');
        Empresa::findOrFail($id)->update($request->all());
        if ($request->emp_logo) {
            //obtenemos el campo file definido en el formulario
            $file = $request->file('emp_logo');
            //obtenemos el nombre del archivo
            $nombre = $request->emp_id . ".jpg";
            //indicamos que queremos guardar un nuevo archivo en el disco local
            Storage::disk('logos')->put($nombre,  File::get($file));
        }

        return redirect('parametros/empresa')->with('mensaje', 'Empresa actualizada exitosamente.');
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
            Empresa::destroy($id);
            Storage::disk('logos')->delete($id . ".jpg");
        } catch (Exception $e) {
            return redirect('parametros/empresa')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('parametros/empresa')->with('mensaje', 'Empresa eliminanda correctamente.');
    }

    public function terminal($id)
    {
        $data = Empresa::findOrFail($id);
        $terms = Terminal::where([['ter_id', '>', 0], ['ter_activo', 1]])->orderBy('ter_id')->get();
        return view('parametros.empresa.terminales', compact('data', 'terms'));
    }

    public function guardarTerminal(Request $request)
    {
        if ($request->ajax()) {
            $empresa = new Empresa();
            if ($request->input('estado') == 1) {
                $empresa->find($request->input('empresa_id'))->Terminales()->attach($request->input('terminal_id'));
                activity('operacion')
                    ->withProperties(['terminal' => $request->input('terminal_id'), 'empresa' => $request->input('empresa_id')])->log('asignacion');
            } else {
                $empresa->find($request->input('empresa_id'))->Terminales()->detach($request->input('terminal_id'));
                activity('operacion')
                    ->withProperties(['terminal' => $request->input('terminal_id'), 'empresa' => $request->input('empresa_id')])->log('desasignacion');
            }
        } else {
            abort(404);
        }
    }

    public function representante($id)
    {
        $data = Empresa::findOrFail($id);
        return view('parametros.empresa.representantes', compact('data'));
    }

    public function crearRepresentante($empresa)
    {
        $data = Empresa::findOrFail($empresa);
        return view('parametros.empresa.crearRepresentantes', compact('data'));
    }

    public function guardarRepresentante(Request $request)
    {
        $data = Empresa::findOrFail($request->rep_empresa);
        $inicioReq = Carbon::createFromFormat('d/m/Y', $request->rep_inicio);
        $fin = Carbon::parse($inicioReq)->format('Y-m-d H:i:s');
        $nomRep = TiposRepresentante::getTipo($request->rep_tipo);
        if ($request->rep_tipo != 2) {
            $representacion = Representacion::where([['rep_representante', $request->rep_representante], ['rep_tipo', $request->rep_tipo], ['rep_empresa', $request->rep_empresa]])->get();
            if (!$representacion->isEmpty()) {
                if (is_null($representacion->first()->rep_fin)) {
                    return redirect(route('empresa.representante', ['id' => $data->emp_id]))->withErrors('El ' . $nomRep . ' seleccionado se encuentra asignado actualmente.');
                } else {
                    $representacion = Representacion::whereNotNull('rep_fin')->where([['rep_tipo', $request->rep_tipo], ['rep_empresa', $request->rep_empresa], ['rep_representante', $request->rep_representante]])->get();
                    $conflicto = 0;
                    foreach ($representacion as $item) {
                        if (($inicioReq > $item->rep_inicio && $inicioReq < $item->rep_fin)) {
                            $conflicto = 1;
                        }
                    }
                    if ($conflicto == 1) {
                        return redirect(route('empresa.representante', ['id' => $data->emp_id]))->withErrors('El ' . $nomRep . ' no puede asignarse debido a un conflicto con las fechas.');
                    } else {
                        $representacion = new Representacion();
                        $data->Representantes()->attach($request->rep_representante, ['rep_tipo' => $request->rep_tipo, 'rep_inicio' => $fin,'rep_constancia'=>$request->rep_constancia]);
                        activity('representante')->performedOn($representacion)
                            ->withProperties(['rep_empresa' => $request->rep_empresa, 'rep_representante' => $request->rep_representante, 'rep_tipo' => $request->rep_tipo, 'attributes' => ['rep_inicio' => $fin, 'rep_fin' => null, 'rep_constancia'=>$request->rep_constancia]])->log('created');
                        return redirect(route('empresa.representante', ['id' => $data->emp_id]))->with('mensaje', $nomRep . ' asignado correctamente.');
                    }
                }
            } else {
                $representacion = new Representacion();
                $data->Representantes()->attach($request->rep_representante, ['rep_tipo' => $request->rep_tipo, 'rep_inicio' => $fin,'rep_constancia'=>$request->rep_constancia]);
                activity('representante')->performedOn($representacion)
                    ->withProperties(['rep_empresa' => $request->rep_empresa, 'rep_representante' => $request->rep_representante, 'rep_tipo' => $request->rep_tipo, 'attributes' => ['rep_inicio' => $fin, 'rep_fin' => null,'rep_constancia'=>$request->rep_constancia]])->log('created');
                return redirect(route('empresa.representante', ['id' => $data->emp_id]))->with('mensaje', $nomRep . ' asignado correctamente.');
            }
        } else {
            $representacion = Representacion::whereNull('rep_fin')->where([['rep_tipo', $request->rep_tipo], ['rep_empresa', $request->rep_empresa]])->first();
            if ($representacion->rep_inicio >= $inicioReq) {
                return redirect(route('empresa.representante', ['id' => $data->emp_id]))->withErrors('No se puede asignar una fecha anterior al contador actual.');
            } elseif ($request->rep_representante == $representacion->rep_representante) {
                return redirect(route('empresa.representante', ['id' => $data->emp_id]))->withErrors('El contador seleccionado se encuentra asignado actualmente.');
            } else {
                $data->Representantes()->wherePivot('rep_tipo', $request->rep_tipo)->updateExistingPivot($representacion->rep_representante, ['rep_fin' => $fin,], true);
                activity('representante')->performedOn($representacion)
                    ->withProperties(['rep_empresa' => $representacion->rep_empresa, 'rep_representante' => $representacion->rep_representante, 'rep_tipo' => $representacion->rep_tipo, 'attributes' => ['rep_fin' => $fin], 'old' => ['rep_fin' => $representacion->rep_fin]])->log('updated');
                $data->Representantes()->attach($request->rep_representante, ['rep_tipo' => $request->rep_tipo, 'rep_inicio' => $fin]);
                activity('representante')->performedOn($representacion)
                    ->withProperties(['rep_empresa' => $request->rep_empresa, 'rep_representante' => $request->rep_representante, 'rep_tipo' => $request->rep_tipo, 'attributes' => ['rep_inicio' => $fin, 'rep_fin' => null]])->log('created');
                return redirect(route('empresa.representante', ['id' => $data->emp_id]))->with('mensaje', 'Contador asignado correctamente.');
            }
        }
    }

    public function editarRepresentante($empresa, $representante, $tipo, $inicio)
    {
        $emp = Empresa::findOrFail($empresa);
        $tip = TiposRepresentante::findOrFail($tipo);
        $inicioReq = Carbon::createFromFormat('Ymd', $inicio);
        $data = Representacion::where([['rep_empresa', $empresa], ['rep_representante', $representante], ['rep_tipo', $tipo], ['rep_inicio', $inicio]])->first();
        return view('parametros.empresa.editarRepresentantes', compact('data', 'emp', 'tip'));
    }

    public function actualizarRepresentante(Request $request)
    {
        if (!($request->habilita)) {
            $fin = null;
            $finold = null;
        } else {
            $fecha = Carbon::createFromFormat('d/m/Y', $request->rep_fin);
            $fin = Carbon::parse($fecha)->format('Y-m-d H:i:s');
            if (!($request->fecnull)) {
                $fecha = Carbon::createFromFormat('d/m/Y', $request->hemp_fin);
                $finold = Carbon::parse($fecha)->format('Y-m-d H:i:s');
            } else {
                $finold = null;
            }
        }
        $data = Empresa::findOrFail($request->rep_empresa);
        $inicioReq = Carbon::createFromFormat('d/m/Y', $request->rep_inicio);
        $inicio = Carbon::parse($inicioReq)->format('Y-m-d H:i:s');
        $fecha = Carbon::createFromFormat('d/m/Y', $request->hemp_inicio);
        $inicioold = Carbon::parse($fecha)->format('Y-m-d H:i:s');
        $Representacion = Representacion::whereNotNull('rep_fin')->where([['rep_tipo', $request->rep_tipo], ['rep_empresa', $request->rep_empresa], ['rep_representante', $request->rep_representante]])->get();
        $conflicto = 0;
        foreach ($Representacion as $item) {
            if (($inicioReq > $item->rep_inicio && $inicioReq < $item->rep_fin)) {
                $conflicto = 1;
            }
        }
        if ($conflicto == 1) {
            return redirect(route('empresa.representante', ['id' => $data->emp_id]))->withErrors('La fecha no se puede modificar porque generaría un coflicto con otra asignación.');
        } else {
            $data->Representantes()->wherePivot('rep_tipo', $request->rep_tipo)->wherePivot('rep_inicio',$inicioold)->updateExistingPivot($request->input('rep_representante'), ['rep_inicio' => $inicio, 'rep_fin' => $fin,'rep_constancia'=>$request->rep_constancia], true);
            $Representacion = new Representacion();
            activity('representante')->performedOn($Representacion)->withProperties([
                'rep_empresa' => $request->rep_empresa, 'rep_representante' => $request->rep_representante, 'rep_tipo' => $request->rep_tipo, 'attributes' => ['rep_inicio' => $inicio, 'rep_fin' => $fin,'rep_constancia'=>$request->rep_constancia],
                'old' => ['rep_inicio' => $inicioold, 'rep_fin' => $finold,'rep_constancia'=>$request->rep_constanciaold]
            ])->log('updated');
            return redirect(route('empresa.representante', ['id' => $data->emp_id]))->with('mensaje', 'Representante actualizado correctamente.');
        }
    }

    public function asignaUsuario(Request $request){
        if ($request->ajax()) {
            $usuario = new Usuario();
            if ($request->input('estado') == 1) {
                $usuario->find($request->input('usuario_id'))->Empresas()->attach($request->input('empresa_id'));
                activity('accesoEmpresa')
                    ->withProperties(['empresa' => $request->input('empresa_id'), 'usuario' => $request->input('usuario_id')])->log('asignacion');
            } else {
                $usuario->find($request->input('usuario_id'))->Empresas()->detach($request->input('empresa_id'));
                activity('accesoEmpresa')
                    ->withProperties(['empresa' => $request->input('empresa_id'), 'usuario' => $request->input('usuario_id')])->log('desasignacion');
            }
        } else {
            abort(404);
        }
    }
}
