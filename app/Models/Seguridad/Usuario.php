<?php

namespace App\Models\Seguridad;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;

class Usuario extends Authenticatable
{
    // use Notifiable;
    use LogsActivity;
    use HasRoles;

    protected $remember_token = false;
    protected $table = 'usuario';
    protected $fillable = ['id', 'usu_nombre', 'usu_pwd', 'usu_activo', 'usu_empleado'];
    protected $guarded = 'id';
    protected $primaryKey = 'id';
    protected static $logName = 'usuario';
    protected static $ignoreChangedAttributes = ['usu_pwd','created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function getAuthPassword()
    {
        return $this->usu_pwd;
    }

    public function Empleados()
    {
        return $this->belongsTo('App\Models\Planilla\Empleado', 'usu_empleado', 'empl_id');
    }

    public function Terminales()
    {
        return $this->belongsToMany('App\Models\Parametros\Terminal','accesoTerminal','acct_usuario','acct_terminal')->withTimestamps();
    }

    public function Empresas()
    {
        return $this->belongsToMany('App\Models\Parametros\Empresa','accesoEmpresa','acce_usuario','acce_empresa')->withTimestamps();
    }



    public function setSession()
    {
        //   if(count($roles)==1){
        Session::put(
            [
                //   'rol_id' => $roles[0]['id'],
                //   'rol_nombre' => $roles[0]['nombre'],
                'usuario_nombre' => $this->usu_nombre,
                'usuario_id' => $this->usu_id,
                // 'usuario' =>$this->email,
                // 'empresas'=>$this->Empresas()->pluck('emp_codigo')->toArray(),
                // 'sucursales'=>$this->Sucursales()->pluck('suc_codigo')->toArray()
            ]
        );
        //  } else {

        // }
    }
}
