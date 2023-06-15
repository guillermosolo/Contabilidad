<?php

namespace App\Models\Parametros;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Empresa extends Model
{
    use LogsActivity;

    protected $table = 'empresa';
    protected $fillable = [
        'emp_id', 'emp_nombre', 'emp_siglas', 'emp_NIT', 'emp_municipio', 'emp_actividad', 'emp_descripcion',
        'emp_regimen', 'emp_fel', 'emp_inicio', 'emp_activa', 'emp_CUI', 'emp_nacionalidad',
        'emp_numeroIGSS', 'emp_colonia', 'emp_zona', 'emp_calle', 'emp_avenida', 'emp_nomenclatura',
        'emp_sitioWeb', 'emp_email', 'emp_sindicato', 'emp_telefono','emp_nomComercial','emp_direccion'
    ];
    protected $guarded = 'emp_id';
    protected $primaryKey = 'emp_id';
    protected static $logName = 'empresa';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logFillable = true;

    public function Departamento()
    {
        return $this->belongsTo('App\Models\Admin\DepMun', 'emp_municipio', 'dep_id');
    }

    public function Regimen()
    {
        return $this->belongsTo('App\Models\Admin\Regimen', 'emp_regimen', 'reg_id');
    }

    public function FEL()
    {
        return $this->belongsTo('App\Models\Admin\Certificador', 'emp_fel', 'cer_id');
    }

    public function Pais()
    {
        return $this->belongsTo('App\Models\Admin\Paises', 'emp_nacionalidad', 'pai_id');
    }

    public function Terminales()
    {
        return $this->belongsToMany('App\Models\Parametros\Terminal', 'operacion', 'ope_empresa', 'ope_terminal')->withTimestamps();
    }

    public function Representantes()
    {
        return $this->belongsToMany('App\Models\Admin\Representante', 'representacion', 'rep_empresa', 'rep_representante')->withTimestamps()->withPivot('rep_inicio', 'rep_fin', 'rep_tipo')->orderBy('representacion.rep_tipo')->orderBy('representacion.rep_inicio');
    }


    public function Productos()
    {
        return $this->belongsTo('App\Models\Cxc\Productos', 'prod_empresa', 'emp_id');
    }

    public function OrdenFacturacion()
    {
        return $this->belongsTo('App\Models\Cxc\OrdenFacturacion', 'ordf_empresa', 'emp_id');
    }

    public function Facturacion()
    {
        return $this->belongsTo('App\Models\Cxc\Facturacion', 'ven_empresa', 'emp_id');
    }

    public function getNit($empid){
        $empresa = new Empresa();
        return $empresa->where('emp_id',$empid)->first()->emp_NIT;
    }

    public function getSigla($empid){
        $empresa = new Empresa();
        return $empresa->where('emp_id',$empid)->first()->emp_siglas;
    }

    public function getNComercial($empid){
        $empresa = new Empresa();
        return $empresa->where('emp_id',$empid)->first()->emp_nomComercial;
    }

    public function getNombre($empid){
        $empresa = new Empresa();
        return $empresa->where('emp_id',$empid)->first()->emp_nombre;
    }

    public function getDireccion($empid){
        $empresa = new Empresa();
        return $empresa->where('emp_id',$empid)->first()->emp_direccion;
    }



    public function getMunicipio($empid){
        $empresa = new Empresa();
        return $empresa->where('emp_id',$empid)->first()->emp_municipio;
    }


    public static function getEmpresas()
    {
        $empresas = new Empresa();
        return $empresas->where('emp_id', '>', '0')->orderBy('emp_id')->get();
    }
    public static function getEmpresasActivas()
    {
        $empresas = new Empresa();
        return $empresas->where([['emp_id', '>', '0'], ['emp_activa', 1]])->orderBy('emp_id')->get();
    }

    public function getSiglas($param)
    {
        $empr = new Empresa();
        $empresa = $empr->where('emp_id', '=', $param)->first();
        $nombre = $empresa['emp_siglas'].''. $empresa['emp_siglas'];
        return $nombre;
    }



    public function getEmp(){
        $emp= Empresa::get();
        $empArray[''] ='Seleccione empresa';
        foreach ($emp as $empresa){
            $empArray[$empresa->emp_id]= $empresa->emp_siglas;
        }
        return $empArray;
    }




}


