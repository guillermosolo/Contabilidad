<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name'=>'Super Administrador']);
        Role::create(['name'=>'Administrador']);
        Role::create(['name'=>'Consulta']);
        Role::create(['name'=>'Contador']);
        Role::create(['name'=>'Auxiliar de Contabilidad']);
        Role::create(['name'=>'Facturación']);
        Role::create(['name'=>'Operador']);
        Role::create(['name'=>'Planillas']);
        Role::create(['name'=>'Auxiliar de Facturación']);

        $rol = Role::findByName('Consulta');
        $permisos = Permission::where('name', 'like', 'ver%')->get();
        foreach ($permisos as $permiso) {
            $permiso->assignRole($rol);
        }
        $rol = Role::findByName('Administrador');
        $permisos = Permission::where('name','not like','%admin/%')->get();
        foreach ($permisos as $permiso){
            $permiso->assignRole($rol);
        }
        $rol = Role::findByName('Contador');
        $permisos = Permission::where('name','not like','%contabilidad/catalogo%')->where('name','not like','%razones%')->where('name','not like','%planillas/reportes/%')->where('name','not like','%admin/%')->where('name','not like','eliminar%')->where('name','not like','%parametros/%')->get();
        foreach ($permisos as $permiso){
            $permiso->assignRole($rol);
        }
        $permiso = Permission::findByName('ver parametros/empresa');
        $permiso->assignRole($rol);
        //$permiso = Permission::findByName('ver contabilidad/catalogo');
        //$permiso->assignRole($rol);
        $rol = Role::findByName('Auxiliar de Contabilidad');

        $rol = Role::findByName('Facturación');
        $permisos = Permission::where('name','not like','eliminar%')->where(function($query){
            $query->where('name','like','%cxc/ventas/facturacion')
                  ->orWhere('name','like','%cxc/ventas/documentos/%');})->get();
        foreach ($permisos as $permiso){
            $permiso->assignRole($rol);
        }
        $permiso = Permission::findByName('ver cxc/ventas/ordenfacturacion');
        $permiso->assignRole($rol);
        $rol = Role::findByName('Operador');
        $permisos = Permission::where('name','not like','eliminar%')->where(function($query){
            $query->where('name','like','%cxp/facturas')
                  ->orWhere('name','like','%cxp/importacion')
                  ->orWhere('name','like','%cxp/recibos');})->get();
        foreach ($permisos as $permiso){
            $permiso->assignRole($rol);
        }

        $rol = Role::findByName('Planillas');


        $rol = Role::findByName('Auxiliar de Facturación');
        $permisos = Permission::where('name','not like','eliminar%')->where('name','like','%cxc/ventas/ordenfacturacion')->get();
        foreach ($permisos as $permiso){
            $permiso->assignRole($rol);
        }
    }
}
