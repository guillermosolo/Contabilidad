<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoContribuyenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipocontribuyente')->insert([[
            'tpc_nombre'=>'Pequeño Contribuyente',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tpc_nombre'=>'General',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]]);
    }
}
