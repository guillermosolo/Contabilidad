<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoPersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipopersona')->insert([[
            'tpp_nombre'=>'Locales',
            'tpp_nickname'=>'LOC',
            'tpp_clasificacion'=>'C',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tpp_nombre'=>'Varios',
            'tpp_nickname'=>'VAR',
            'tpp_clasificacion'=>'C',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tpp_nombre'=>'Relacionadas por Cobrar',
            'tpp_nickname'=>'RELAC',
            'tpp_clasificacion'=>'C',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tpp_nombre'=>'Compras y Servicios',
            'tpp_nickname'=>'COM',
            'tpp_clasificacion'=>'P',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tpp_nombre'=>'Servicios Permanentes',
            'tpp_nickname'=>'SPE',
            'tpp_clasificacion'=>'P',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],
        [
            'tpp_nombre'=>'Relacionadas por Pagar',
            'tpp_nickname'=>'RELAP',
            'tpp_clasificacion'=>'P',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]]);
    }
}
