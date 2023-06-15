<?php

namespace App\Http\Controllers\Parametros;

use Exception;
use App\Models\Admin\Menu;
use Illuminate\Http\Request;
use App\Models\Seguridad\Usuario;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Role::where('id','!=',1)->orderBy('id')->get();
        return view('parametros.rol.index',compact('datas'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parametros.rol.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            Role::create(['name'=>$request->name]);
        } catch  (Exception $e) {
            if ($e instanceof \Spatie\Permission\Exceptions\RoleAlreadyExists){
                    return redirect('parametros/rol')->withErrors('No se puede crear el rol, porque ya existe un rol con el nombre <b>' . $request->name . '</b>');
            } else {
                return redirect('parametros/rol')->withErrors('Error no contemplado, comuníquese con el <b> Administrador del Sistema</b>');
            }
        }
        return redirect('parametros/rol')->with('mensaje', 'Rol creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function asignarPermisos($id)
    {
        $data = Role::findById($id);
        $menu = Menu::getMenu();
        return view('parametros.rol.permisos',compact('data','menu'));
    }

    public function guardarPermisos(Request $request){
        if ($request->ajax()) {
            $rol = new Role();
            if ($request->input('estado') == 1) {
                $rol->findByName($request->rol)->givePermissionTo($request->permiso);
            } else {
                $rol->findByName($request->rol)->revokePermissionTo($request->permiso);
            }
        } else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rol = Role::findById($id);
        if ($rol->users->isEmpty()){
            try {
                Role::destroy($id);
            } catch (Exception $e) {
                return redirect('parametros/rol')->withErrors(['catch', $e->errorInfo]);
            }
            return redirect('parametros/rol')->with('mensaje', 'Rol eliminando correctamente.');
        } else {
            return redirect('parametros/rol')->withErrors('El rol no se puede eliminar porque hay usuarios asignados a ese rol.');
        }
    }

    public function guardarRol(Request $request){
        if($request)
         if ($request->ajax()) {
             $usuario = new Usuario();
             if ($request->input('estado') == 1) {
                 $usuario->find($request->usuario_id)->assignRole($request->rol_name);
                 activity('roles')
                     ->withProperties(['usuario' => $request->input('usuario_id'), 'rol' => $request->input('rol_name'), 'autoriza'=>$request->input('autorizo')])->log('asignacion');
             } else {
                 $usuario->find($request->usuario_id)->removeRole($request->rol_name);
                 activity('roles')
                 ->withProperties(['usuario' => $request->input('usuario_id'), 'rol' => $request->input('rol_name')])->log('desasignacion');
             }
     } else {
             abort(404);
         }
     }

     public function guardarPermisosDirectos(Request $request){
        if ($request->ajax()) {
            $usuario = new Usuario();
            if ($request->input('estado') == 1) {
                $usuario->findOrFail($request->usuario_id)->givePermissionTo($request->permiso);
            } else {
                $usuario->findOrFail($request->usuario_id)->revokePermissionTo($request->permiso);
            }
        } else {
            abort(404);
        }
     }
}
