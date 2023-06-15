<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CorrelativoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('CorrelativoInt')->insert([[
            'corr_empresa' => 0,
            'corr_terminal' => 0,
            'corr_tipo' => 'N',
            'corr_mes' => 0,
            'corr_anio' => 0,
            'corr_especifico' => 0,
            'corr_general' => 0,
            'corr_correlativo' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]]);
    }
}
