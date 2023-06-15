<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class DepMun extends Model
{
    protected $table = 'depmun';
    protected $primaryKey = 'dep_id';
    protected $keyType = 'string';

    public function terminales()
    {
        return $this->hasMany('App\Models\Admin\Terminal','ter_municipio','dep_id');
    }

    public function empresas()
    {
        return $this->hasMany('App\Models\Parametros\Empresa','emp_municipio','dep_id');
    }

    public static function getDepartamentos()
    {
        $deptos = new DepMun();
       return $deptos->where([['dep_id','like',"%00"],['dep_id','not like','%0000']])->orderBy('dep_id')->get();
    }

    public static function getMun($param)
    {
        $depto = new DepMun();
        return $depto->where('dep_id','like',$param."%")->first()->dep_descripcion;
    }

    public static function getDepto($param)
    {
        $depto = new DepMun();
        $param = substr($param,0,strlen($param)-2);
       return $depto->where('dep_id','like',$param . "00")->first()->dep_descripcion;
    }

    public static function getMunicipios($depto)
    {
        $municipios = new DepMun();
        return $municipios
        ->where([['dep_id','like',$depto."%"],['dep_id','not like',"%00"]])
        ->orderBy('dep_id')->get();
    }

    public static function getRegiones()
    {
        $regiones = new DepMun();
        return $regiones
        ->where('dep_id','like',"%0000")->orderBy('dep_id')->get();
    }

    public static function getDescLg($municipio)
    {
        $municipios = new DepMun();
        $descLg =$municipios->getMun($municipio) . ', ' . $municipios->getDepto($municipio);
        return $descLg;
    }
}
