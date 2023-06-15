<?php

namespace App\Http\Controllers\cyb;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Controller;
use App\Http\Requests\cyb\ValidacionCuentasBancarias;
use App\Models\Admin\Bancos;
use App\Models\Contabilidad\CuentaContable;
use App\Models\cyb\CuentasBancarias;
use App\Models\Admin\Moneda;
use App\Models\Parametros\Empresa;
use App\Models\cyb\TipoCuenta;
use Illuminate\Http\Request;

class CuentasBancariasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $buscar=$request->get('buscar');
        if (auth()->user()->hasRole('Super Administrador'))
        {
            $cuentasbancariass = CuentasBancarias::where('ctab_numero', 'LIKE', '%' .$buscar. '%' )->get();
        }else
        {
            $emp = auth()->user()->Empresas->pluck('emp_id');
            $cuentasbancariass = CuentasBancarias::where('ctab_numero', 'LIKE', '%' .$buscar. '%' )->whereIn('ctab_empresa', $emp)->get();
        }

        return view('cyb.bancos.cuentasbancarias.index', compact('cuentasbancariass', 'buscar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipocuentas = TipoCuenta::all();
        $bancoss = Bancos::all();
        $monedas = Moneda::all();
        $empresas = Empresa::all();
        $cuentacontables = CuentaContable::orderby('cta_id')->get();
        return view('cyb.bancos.cuentasbancarias.crear', compact('tipocuentas', 'bancoss', 'monedas', 'empresas', 'cuentacontables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionCuentasBancarias $request)
    {
        $data = $request->validated();
        CuentasBancarias::create($data);
        return redirect()->route('cuentasbancarias')->with('mensaje', 'Cuenta Bancaria creado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('cyb.bancos.cuentasbancarias.catalogo');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipocuentas = TipoCuenta::all();
        $bancoss = Bancos::all();
        $monedas = Moneda::all();
        $empresas = Empresa::all();
        $cuentacontables = CuentaContable::orderby('cta_id')->get();
        $cuentasbancariass = CuentasBancarias::find($id);
        return view('cyb.bancos.cuentasbancarias.editar', compact('cuentasbancariass', 'tipocuentas', 'bancoss', 'empresas', 'cuentacontables', 'monedas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionCuentasBancarias $request, $id)

    {
        $cuentasBancariass = CuentasBancarias::find($id);
        $data = $request->validated();
        $cuentasBancariass->fill($data);
        $cuentasBancariass->save();
        return redirect()->route('cuentasbancarias')->with(["mensaje"=>"Registro actualizado con Éxito"]);
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
            $cuentasbancariass= CuentasBancarias::find($id);
            $cuentasbancariass->delete();
            return redirect()->route('cuentasbancarias')->with(["mensaje"=>"Registro eliminado con éxito"]);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('cuentasbancarias')->withErrors(['catch', $e->errorInfo]);
        }
    }

    public function imprimir(Request $request)
    {
        $dato = $request->get('search');
        if ($dato>0) {
            $cuentasbancariass = CuentasBancarias::where('ctab_empresa', $dato)->get();
        } else {
            $cuentasbancariass = CuentasBancarias::orderby('ctab_empresa');
            if (auth()->user()->hasRole('Super Administrador')) {
                $cuentasbancariass = $cuentasbancariass->get();
            } else {
                $emp = auth()->user()->Empresas->pluck('emp_id');
                $cuentasbancariass = $cuentasbancariass->whereIn('ctab_empresa', $emp)->get();
            }
        };
        return view('cyb.bancos.cuentasbancarias.imprimir', compact('cuentasbancariass', 'dato'));
    }

}
