<?php

namespace App\Http\Controllers\Parametros;


use Exception;
use App\Models\Admin\Menu;
use Illuminate\Http\Request;
use App\Models\Seguridad\Usuario;
use Spatie\Permission\Models\Role;
use App\Models\Parametros\Terminal;
use App\Http\Controllers\Controller;
use App\Http\Requests\Parametros\ValidacionUsuario;
use App\Models\Parametros\Empresa;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Usuario::where('id','!=',1)->orderBy('id')->get();
        return view('parametros.usuario.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parametros.usuario.crear');
    }

    public function store(ValidacionUsuario $request)
    {
        $request->merge(['usu_pwd'=>bcrypt($request->usu_pwd)]);
        Usuario::create($request->all());
        return redirect('parametros/usuario')->with('mensaje', 'Usuario creado exitosamente.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Usuario::findOrFail($id);
        $menu = Menu::getMenu();
        $permisosrol = $data->getPermissionsViaRoles()->pluck('name')->toArray();
        return view('parametros.usuario.mostrar',compact('data','menu','permisosrol'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Usuario::findOrFail($id);
        return view('parametros.usuario.editar',compact('data'));
    }

    public function editC($id)
    {
       $data = Usuario::findOrFail($id);
       return view('parametros.usuario.editarC',compact('data'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionUsuario $request, $id)
    {
        if (!($request->usu_activo)) {
            $request->merge(['usu_activo' => '0']);
        }
        Usuario::findOrFail($id)->update($request->all());
        return redirect('parametros/usuario')->with('mensaje', 'Usuario actualizado correctamente.');
    }

    public function updateC(ValidacionUsuario $request, $id)
    {
        $request->merge(['usu_pwd'=>bcrypt($request->usu_pwd)]);
        Usuario::findOrFail($id)->update($request->all());
        return redirect('parametros/usuario')->with('mensaje', 'Contraseña actualizada correctamente.');
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
            Usuario::destroy($id);
        } catch (Exception $e) {
            return redirect('parametros/usuario')->withErrors(['catch', $e->errorInfo]);
        }
        return redirect('parametros/usuario')->with('mensaje', 'Usuario eliminando correctamente.');
    }

    public function roles($id){
        $data = Usuario::findOrFail($id);
        $roles = Role::where('id','!=',1)->orderBy('id')->get();
        return view('parametros.usuario.roles',compact('data','roles'));
    }

    public function permisos($id){
        $data = Usuario::findOrFail($id);
        $menu = Menu::getMenu();
        $permisosrol = $data->getPermissionsViaRoles()->pluck('name')->toArray();
        return view('parametros.usuario.permisos',compact('data','menu','permisosrol'));
    }

    public function terminales($id){
        $data = Usuario::findOrFail($id);
        $terms = Terminal::where([['ter_id', '>', 0], ['ter_activo', 1]])->orderBy('ter_id')->get();
        return view('parametros.usuario.terminales', compact('data', 'terms'));
    }

    public function empresas($id){
        $data = Usuario::findOrFail($id);
        $emps = Empresa::where([['emp_id', '>', 0], ['emp_activa', 1]])->orderBy('emp_id')->get();
        return view('parametros.usuario.empresas', compact('data', 'emps'));
    }
}
