<?php

namespace App\Http\Controllers\Parametros;

use App\Models\cyb\CuentasBancarias;
use Exception;
use Illuminate\Http\Request;
use App\Models\Seguridad\Usuario;
use App\Models\Parametros\Terminal;
use App\Http\Controllers\Controller;
use App\Http\Requests\Parametros\ValidacionTerminal;
use App\Models\Parametros\Empresa;

class TerminalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Terminal::where('ter_id', '>', 0)->orderBy('ter_id')->get();
        return view('parametros.terminal.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parametros.terminal.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionTerminal $request)
    {
        if (!($request->ter_activo)) {
            $request->merge(['ter_activo' => '0']);
        }
        $ultimo = Terminal::max('ter_id');
        $request->merge(['ter_id' => $ultimo + 1]);
        Terminal::create($request->all());
        return redirect('parametros/terminal')->with('mensaje', 'Terminal creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Terminal::findOrFail($id);
        return view('parametros.terminal.editar', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionTerminal $request, $id)
    {
        if (!($request->ter_activo)) {
            $request->merge(['ter_activo' => '0']);
        }
        Terminal::findOrFail($id)->update($request->all());
        return redirect('parametros/terminal')->with('mensaje', 'Terminal actualizada correctamente.');
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
            Terminal::destroy($id);
        } catch (Exception $e) {
            return redirect('parametros/terminal')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('parametros/terminal')->with('mensaje', 'Terminal eliminanda correctamente.');
    }

    public function asignaUsuario(Request $request)
    {
        if ($request->ajax()) {
            $usuario = new Usuario();
            if ($request->input('estado') == 1) {
                $usuario->find($request->input('usuario_id'))->Terminales()->attach($request->input('terminal_id'));
                activity('accesoTerminal')
                    ->withProperties(['terminal' => $request->input('terminal_id'), 'usuario' => $request->input('usuario_id')])->log('asignacion');
            } else {
                $usuario->find($request->input('usuario_id'))->Terminales()->detach($request->input('terminal_id'));
                activity('accesoTerminal')
                    ->withProperties(['terminal' => $request->input('terminal_id'), 'usuario' => $request->input('usuario_id')])->log('desasignacion');
            }
        } else {
            abort(404);
        }
    }

    public function Terminales(Request $request)
    {
        if ($request->ajax()) {
            $terminales = Terminal::getTerminales();
            return response()->json($terminales);
        } else {
            abort(404);
        }
    }

    public function TerminalesAuth(request $request, $id)
    {
        if ($request->ajax()) {
            $terminales = $this->getTerminales($id);
            return response()->json($terminales);
        } else {
            abort(404);
        }
    }
//    public function TerminalesAuth(request $request, $id)
//    {
//        if ($request->ajax()) {
//            $emp = Empresa::findOrFail($id);
//            if (auth()->user()->hasRole('Super Administrador')) {
//                $terminales = $emp->Terminales;
//            } else {
//                $terAuth = auth()->user()->Terminales->pluck('ter_id');
//                $terminales = $emp->Terminales->whereIn('ter_id', $terAuth);
//            }
//            return response()->json($terminales);
//        } else {
//            abort(404);
//        }
//    }
    public function getTerminales($id){
        $emp = Empresa::findOrFail($id);
        if (auth()->user()->hasRole('Super Administrador')) {
            $terminales = $emp->Terminales;
        } else {
            $terAuth = auth()->user()->Terminales->pluck('ter_id');
            $terminales = $emp->Terminales->whereIn('ter_id', $terAuth);
        }
        return $terminales;
    }

    public function TerminalesCuentaBancariaAuth(request $request, $id)
    {
        if ($request->ajax()) {
            $cuentabancaria = CuentasBancarias::findOrFail($id);
            $emp = Empresa::findOrFail($cuentabancaria->ctab_empresa);
            if (auth()->user()->hasRole('Super Administrador')) {
                $terminales = $emp->Terminales;
            } else {
                $terAuth = auth()->user()->Terminales->pluck('ter_id');
                $terminales = $emp->Terminales->whereIn('ter_id', $terAuth);
            }
            return response()->json($terminales);
        } else {
            abort(404);
        }
    }
}
