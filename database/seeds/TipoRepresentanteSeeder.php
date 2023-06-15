<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoRepresentanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tiporepresentante')->insert([[
            'trep_nombre'=>'Representante Legal',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'trep_nombre'=>'Contador',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'trep_nombre'=>'Presidente',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'trep_nombre'=>'Vicepresidente',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'trep_nombre'=>'Secretario/a',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
        ]]);
    }
}
