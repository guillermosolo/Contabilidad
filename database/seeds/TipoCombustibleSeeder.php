<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoCombustibleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipocombustible')->insert([[
            'tco_nombre'=>'Gasolina superior',
            'tco_idp'=>4.70,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'tco_nombre'=>'Gasolina regular',
            'tco_idp'=>4.60,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
            'tco_nombre'=>'Gasolina de aviación (AVGAS)',
            'tco_idp'=>4.70,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'tco_nombre' => 'Diesel y Gas Oil',
            'tco_idp' => 1.30,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'tco_nombre' => 'Kerosina',
            'tco_idp' => 0.50,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'tco_nombre' => 'Kerosina para motores de reacción (JET A)',
            'tco_idp' => 0.50,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'tco_nombre' => 'Nafta',
            'tco_idp' => 0.50,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]]);
    }
}
