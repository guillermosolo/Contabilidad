<?php

use Illuminate\Database\Seeder;
use App\Models\Seguridad\Usuario;
use App\Models\Parametros\Empresa;
use App\Models\Parametros\Terminal;
use Illuminate\support\Facades\DB;


class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuario')->insert([[
            'usu_nombre' => 'sa',
            'usu_pwd' => bcrypt('sa'),
            'usu_activo' => 1,
            'usu_empleado' => 0
        ], [
            'usu_nombre' => 'nvasquez',
            'usu_pwd' => bcrypt('nvasquez'),
            'usu_activo' => 1,
            'usu_empleado' => 1
        ],[
            'usu_nombre' => 'creyes',
            'usu_pwd' => bcrypt('creyes'),
            'usu_activo' => 1,
            'usu_empleado' => 2
        ],[
            'usu_nombre' => 'wmolina',
            'usu_pwd' => bcrypt('wmolina'),
            'usu_activo' => 1,
            'usu_empleado' => 3
        ],[
            'usu_nombre' => 'sgarcia',
            'usu_pwd' => bcrypt('sgarcia'),
            'usu_activo' => 1,
            'usu_empleado' => 4
        ],[
            'usu_nombre' => 'abamaca',
            'usu_pwd' => bcrypt('abamaca'),
            'usu_activo' => 1,
            'usu_empleado' => 5
        ],[
            'usu_nombre' => 'eyat',
            'usu_pwd' => bcrypt('eyat'),
            'usu_activo' => 1,
            'usu_empleado' => 6
        ],[
            'usu_nombre' => 'ryat',
            'usu_pwd' => bcrypt('ryat'),
            'usu_activo' => 1,
            'usu_empleado' => 7
        ],[
            'usu_nombre' => 'gecheverria',
            'usu_pwd' => bcrypt('gecheverria'),
            'usu_activo' => 1,
            'usu_empleado' => 8
        ],[
            'usu_nombre' => 'zcallejas',
            'usu_pwd' => bcrypt('zcallejas'),
            'usu_activo' => 1,
            'usu_empleado' => 9
        ],[
            'usu_nombre' => 'rurbina',
            'usu_pwd' => bcrypt('rurbina'),
            'usu_activo' => 1,
            'usu_empleado' => 10
        ],[
            'usu_nombre' => 'ncalderon',
            'usu_pwd' => bcrypt('ncalderon'),
            'usu_activo' => 1,
            'usu_empleado' => 11
        ],[
            'usu_nombre' => 'asamayoa',
            'usu_pwd' => bcrypt('asamayoa'),
            'usu_activo' => 1,
            'usu_empleado' => 12
        ],[
            'usu_nombre' => 'jurizar',
            'usu_pwd' => bcrypt('jurizar'),
            'usu_activo' => 1,
            'usu_empleado' => 13
        ],
    ]);
        $user = Usuario::find(1);
        $user->assignRole(['Super Administrador']);
        $empresas = Empresa::where('emp_id','>',0)->get();
        foreach($empresas as $emp){
            $user->Empresas()->attach($emp->emp_id);
        }
        $terminales = Terminal::where('ter_id','>',0)->get();
        foreach($terminales as $ter){
            $user->Terminales()->attach($ter->ter_id);
        }
        $user = Usuario::find(2);
        $user->assignRole(['Consulta']);
        $user->Empresas()->attach([1,2,3,4,5,6,7,8]);
        foreach($terminales as $ter){
            $user->Terminales()->attach($ter->ter_id);
        }
        $user = Usuario::find(3);
        $user->assignRole(['Consulta']);
        $user->Empresas()->attach([1,2,3,4,5,6,7,8]);
        foreach($terminales as $ter){
            $user->Terminales()->attach($ter->ter_id);
        }
        $user = Usuario::find(4);
        $user->assignRole(['Contador']);
        $user->Empresas()->attach([1,9]);
        foreach($terminales as $ter){
            $user->Terminales()->attach($ter->ter_id);
        }
        $user = Usuario::find(5);
        $user->assignRole(['Contador']);
        $user->Empresas()->attach([2,4,10]);
        foreach($terminales as $ter){
            $user->Terminales()->attach($ter->ter_id);
        }
        $user = Usuario::find(6);
        $user->assignRole(['Contador']);
        $user->Empresas()->attach([3]);
        foreach($terminales as $ter){
            $user->Terminales()->attach($ter->ter_id);
        }
        $user = Usuario::find(7);
        $user->assignRole(['Contador']);
        $user->Empresas()->attach([5,6]);
        foreach($terminales as $ter){
            $user->Terminales()->attach($ter->ter_id);
        }
        $user = Usuario::find(8);
        $user->assignRole(['Contador']);
        $user->Empresas()->attach([7,8]);
        foreach($terminales as $ter){
            $user->Terminales()->attach($ter->ter_id);
        }
        $user = Usuario::find(9);
        $user->assignRole(['Operador']);
        $user->assignRole(['Facturación']);
        $user->Empresas()->attach([1,2,3,4,5,6,7,8]);
        foreach($terminales as $ter){
            $user->Terminales()->attach($ter->ter_id);
        }
        $user = Usuario::find(10);
        $user->assignRole(['Auxiliar de Contabilidad']);
        $user->Empresas()->attach([1,2,3]);
        $user->Terminales()->attach([3]);

        $user = Usuario::find(11);
        $user->assignRole(['Auxiliar de Contabilidad']);
        $user->Empresas()->attach([1,2,3,4,5,6,7,8]);
        $user->Terminales()->attach([1]);
        $user = Usuario::find(12);
        $user->assignRole(['Planillas']);
        $user->Empresas()->attach([7,8]);
        $user->Terminales()->attach([1]);
        $user = Usuario::find(13);
        $user->assignRole(['Consulta']);
        $user->Empresas()->attach([1,2,3,4,5,6,7,8]);
        foreach($terminales as $ter){
            $user->Terminales()->attach($ter->ter_id);
        }
        $user = Usuario::find(14);
        $user->assignRole(['Super Administrador']);
        $user->Empresas()->attach([1,2,3,4,5,6,7,8]);
        foreach($terminales as $ter){
            $user->Terminales()->attach($ter->ter_id);
        }
    }
}
