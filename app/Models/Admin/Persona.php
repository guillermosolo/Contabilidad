<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Persona extends Model
{
    use LogsActivity;

    protected $table = 'personas';
    protected $fillable = ['per_nit', 'per_cui', 'per_nombre', 'per_direccion', 'per_telefono', 'per_contacto', 'per_email', 'per_tipoContribuyente'];
    protected $guarded = 'per_id';
    protected $primaryKey = 'per_id';
    protected static $logName = 'persona';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function Proveedor()
    {
        return $this->hasOne('App\Models\cxp\Proveedor', 'pro_persona', 'per_id');
    }

    public function TipoContribuyente()
    {
        return $this->belongsTo('App\Models\Admin\TipoContribuyente', 'per_tipoContribuyente', 'tpc_id');
    }

    public function Clientes()
    {
        return $this->hasOne('App\Models\Cxc\Clientes', 'cli_persona', 'per_id');
    }


    public static function getPersona()
    {
        $persona = new Persona();
        return $persona->where('per_id', '>', '0')->orderBy('per_id')->get();
    }


       public function getEmail($perid){
        $cliente = new Persona();
        return $cliente->where('per_id',$perid)->first()->per_email;
    }

    public function getNit($perid){
        $cliente = new Persona();
        return $cliente->where('per_id',$perid)->first()->per_nit;
    }

    public function getNombreCli($perid){
            $cliente = new Persona();
            return $cliente->where('per_id',$perid)->first()->per_nombre;
        }

        public function getDireccionCli($perid){
            $cliente = new Persona();
            return $cliente->where('per_id',$perid)->first()->per_direccion;
        }



}
