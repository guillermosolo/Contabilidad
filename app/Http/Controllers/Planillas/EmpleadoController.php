<?php

namespace App\Http\Controllers\Planillas;

use Exception;

use App\Http\Controllers\Controller;
use App\Http\Requests\Planillas\ValidacionEmpleado;
use App\Http\Requests\Planillas\ValidacionEmpleadoExtranjero;
use App\Models\Admin\Idioma;
use App\Models\Planilla\Empleado;
use App\Models\Planilla\EmpleadoExtranjero;
use App\Models\Planilla\EmpleadoIdioma;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Table;

class EmpleadoController extends Controller
{

    public function index(Request $request)
    {
        $this->resetSessionData($request);
        if (auth()->user()->hasRole('Super Administrador')) {
            $datas = Empleado::orderBy('empl_id')->get();
        } else {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $ter = auth()->user()->Terminales->pluck('ter_id');
            $datas = Empleado::whereIn('empl_empresa', $emp)->whereIn('empl_terminal', $ter)->orderBy('empl_id')->where('empl_id', '>', 0)->get();
        }
        return view('planillas.empleados.index', compact('datas'));
    }

    public function create(Request $request)
    {
        $this->resetSessionData($request);
        $empleado = new Empleado();
        return view('planillas.empleados.crear', compact('empleado'));

    }


    public function store(ValidacionEmpleado $request)
    {
        if ($request->empl_extranjero) {
            $data = $request->validated();
            $request->session()->put(['dataEmpl' => $data]);
            return view('planillas.empleados.extranjero.crear');
        } else {
            $data = $request->validated();
            $this->insertEmpleado($data, []);
            return redirect('planillas/empleados')->with('mensaje', 'Empleado creado con exito.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $idiomasSelecionados = $this->getIdiomasEmpleado($id)[1];
        $dataExt = EmpleadoExtranjero::where('trex_empleado', $id)->get();
        $empleado = Empleado::find($id);
        $editForm = false;
        return view('planillas.empleados.editar', compact('empleado', 'idiomasSelecionados', 'dataExt', 'editForm'));
    }


    public function update(ValidacionEmpleado $request, $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                $empleado = Empleado::find($id);
                $data = $request->validated();
                unset($data['empl_fecNac']);
                unset($data['empl_inicio']);
                if (!($empleado->empl_retiro)) {
                    if ($data['empl_retiro']) {
                        $data['empl_retiro'] = $data['empl_retiro'] ? Carbon::parse(Carbon::createFromFormat('d/m/Y', $data['empl_retiro']))->format('Y-m-d H:i:s') : null;
                    }
                } else {
                    unset($data['empl_retiro']);
                }
                if ($data['empl_idiomas']) {
                    $idiomasSelecionados = explode(",", $data['empl_idiomas']);
                }else{
                    $idiomasSelecionados=[];
                }
                $this->updateIdiomas($empleado, $idiomasSelecionados);
                $empleado->fill($data);
                $empleado->save();
            });
        } catch (Exception $e) {
            return redirect('planillas/empleados')->withErrors(['catch2', $e->errorInfo]);
        }
        return redirect('planillas/empleados')->with('mensaje', 'Empleado actualizado con exito.');

    }


    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            try {
                EmpleadoIdioma::where('ei_empleado', $id)->delete();
                EmpleadoExtranjero::where('trex_empleado', $id)->delete();
                Empleado::destroy($id);
            } catch (Exception $e) {
                return redirect('planillas/empleados')->withErrors(['catch', $e->errorInfo]);
            }
            return redirect('planillas/empleados')->with('mensaje', 'Empleado eliminando correctamente.');
        });

    }

    public function storeEmpleadoExt(ValidacionEmpleadoExtranjero $request)
    {
        if ($request->session()->has('dataEmpl')) {
            if ($request->more_ext == 1) {
                $dataExt = $request->validated();
                if ($request->session()->has('dataEXT')) {
                    $request->session()->push('dataEXT', $dataExt);
                } else {
                    $request->session()->put(['dataEXT' => collect([$dataExt])]);
                }
                $request->session()->flash('mensaje', 'Trabajo agregado con exito!');
                return view('planillas.empleados.extranjero.crear');
            } else {
                $dataExt = $request->validated();
                if ($request->session()->has('dataEXT')) {
                    $request->session()->push('dataEXT', $dataExt);
                    $this->insertEmpleado($request->session()->get('dataEmpl'), $request->session()->get('dataEXT'));
                } else {
                    $this->insertEmpleado($request->session()->get('dataEmpl'), collect([$dataExt]));
                }
                $this->resetSessionData($request);
                return redirect('planillas/empleados')->with('mensaje', 'Empleado creado con exito.');
            }
        } else {
            return redirect('planillas/empleados')->with('mensaje', 'A ocurrido un error.');
        }
    }

    public function storeExt(ValidacionEmpleadoExtranjero $request, $id)
    {

        $data = $request->validated();
        $data['trex_empleado'] = $id;
        unset($data['more_ext']);
        EmpleadoExtranjero::create($data);
        return redirect()->route('empleados.editar', ['id' => $id])->with('mensaje', 'Informacion de extranjero agregada con exito.');

    }

    public function destroyExt($id)
    {
        $idEmpleado = EmpleadoExtranjero::where('trex_id', $id)->first()->trex_empleado;
        try {
            DB::table('trabajoextranjero')->where('trex_id', '=', $id)->delete();
        } catch (Exception $e) {
            return redirect()->route('empleados.editar', ['id' => $idEmpleado])->withErrors(['catch', $e->errorInfo]);
        }
        return redirect()->route('empleados.editar', ['id' => $idEmpleado])->with('mensaje', 'Datos de empleo extranjero eliminando correctamente.');
    }

    private function insertEmpleado($data, $dataExt)
    {
        try {
            DB::transaction(function () use ($data, $dataExt) {
                if ($data['empl_idiomas']) {
                    $idiomas = explode(",", $data['empl_idiomas']);
                }else{
                    $idiomas=[];
                }
                unset($data['empl_extranjero']);
                unset($data['empl_idiomas']);
                $data['empl_fecNac'] = Carbon::parse(Carbon::createFromFormat('d/m/Y', $data['empl_fecNac']))->format('Y-m-d H:i:s');
                $data['empl_inicio'] = Carbon::parse(Carbon::createFromFormat('d/m/Y', $data['empl_inicio']))->format('Y-m-d H:i:s');
                $data['empl_retiro'] = $data['empl_retiro'] ? Carbon::parse(Carbon::createFromFormat('d/m/Y', $data['empl_retiro']))->format('Y-m-d H:i:s') : null;

                $idEmpleado = Empleado::latest('empl_id')->first();
                $data['empl_id'] = $idEmpleado->empl_id + 1;
                Empleado::create($data);
                    foreach ($idiomas as $item) {
                        $empIdioma = new EmpleadoIdioma();
                        $empIdioma->ei_empleado = $data['empl_id'];
                        $empIdioma->ei_idioma = $item;
                        $empIdioma->save();
                    }

                foreach ($dataExt as $item) {
                    $empExt = new EmpleadoExtranjero();
                    $empExt->trex_empleado = $data['empl_id'];
                    $empExt->trex_pais = $item['trex_pais'];
                    $empExt->trex_ocupacion = $item['trex_ocupacion'];
                    $empExt->trex_motivo = $item['trex_motivo'];
                    $empExt->save();
                }
            });
        } catch (Exception $e) {
            return redirect('planillas/empleados')->withErrors(['catch2', $e->errorInfo]);
        }

    }

    private function updateIdiomas($empleado, $idiomasSelecionados)
    {
        $idiomasEmpleado = $this->getIdiomasEmpleado($empleado->empl_id);
        foreach ($idiomasSelecionados as $item) {
            if (!(in_array($item, $idiomasEmpleado[1]))) {
                $empIdioma = new EmpleadoIdioma();
                $empIdioma->ei_empleado = $empleado->empl_id;
                $empIdioma->ei_idioma = $item;
                $empIdioma->save();
            }
        }
        foreach ($idiomasEmpleado[0] as $item) {
            if (!(in_array($item->idioma, $idiomasSelecionados))) {
                DB::table('empleadoidiomas')->where('ei_empleado', '=', $empleado->empl_id)->where('ei_idioma', '=', $item->idioma)->delete();
            }
        }
    }

    private function resetSessionData($request)
    {
        if ($request->session()->has('dataEmpl')) {
            $request->session()->forget(['dataEmpl']);
        }
        if ($request->session()->has('dataEXT')) {
            $request->session()->forget(['dataEXT']);
        }
    }

    private function getIdiomasEmpleado($id)
    {
        $idiomasSelecionados = [];
        $idiomas = EmpleadoIdioma::where('ei_empleado', $id)->select('ei_idioma as idioma')->get();
        foreach ($idiomas as $item) {
            array_push($idiomasSelecionados, $item->idioma);
        }
        return collect([$idiomas, $idiomasSelecionados]);
    }

    public function getEmpleados(Request $request, $empresa, $terminal, $tipo = 'M')
    {
        if ($request->ajax()) {
            $datas = Empleado::orderBy('empl_id')->where('empl_id', '>', 0)
                ->where('empl_terminal', $terminal)
                ->where('empl_empresa', $empresa)
                ->where('empl_tipoSalario', '=', $tipo)
                ->get();
            return response()->json($datas);
        } else {
            abort(404);
        }

    }
}
