<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TerminalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('terminal')->insert([[
            'ter_id'=>0,
            'ter_nombre'=>'Sin Terminal',
            'ter_abreviatura'=>'',
            'ter_municipio'=>'00000',
            'ter_autoriza'=>'Carga Inicial',
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'ter_id'=>1,
            'ter_nombre'=>'Puerto Quetzal',
            'ter_abreviatura'=>'PQ',
            'ter_municipio'=>'V0509',
            'ter_autoriza'=>'Carga Inicial',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'ter_id'=>2,
            'ter_nombre'=>'Arizona',
            'ter_abreviatura'=>'AZ',
            'ter_municipio'=>'V0509',
            'ter_autoriza'=>'Carga Inicial',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'ter_id'=>3,
            'ter_nombre'=>'Villa Nueva',
            'ter_abreviatura'=>'VN',
            'ter_municipio'=>'I0115',
            'ter_autoriza'=>'Carga Inicial',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'ter_id'=>4,
            'ter_nombre'=>'Santo Tomás de Castilla',
            'ter_abreviatura'=>'ST',
            'ter_municipio'=>'III1801',
            'ter_autoriza'=>'Carga Inicial',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'ter_id'=>5,
            'ter_nombre'=>'Puerto Barrios',
            'ter_abreviatura'=>'PB',
            'ter_municipio'=>'III1801',
            'ter_autoriza'=>'Carga Inicial',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'ter_id'=>6,
            'ter_nombre'=>'Zacapa',
            'ter_abreviatura'=>'ZA',
            'ter_municipio'=>'III1903',
            'ter_autoriza'=>'Carga Inicial',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'ter_id'=>7,
            'ter_nombre'=>'Planta Atunera',
            'ter_abreviatura'=>'PA',
            'ter_municipio'=>'V0509',
            'ter_autoriza'=>'Carga Inicial',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'ter_id'=>99,
            'ter_nombre'=>'Oficinas Centrales',
            'ter_abreviatura'=>'OF',
            'ter_municipio'=>'I0101',
            'ter_autoriza'=>'Carga Inicial',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
        ]]);

    }
}
