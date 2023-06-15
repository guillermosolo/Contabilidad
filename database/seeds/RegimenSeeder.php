<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegimenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regimen')->insert([
            ['reg_descripcion' => 'OPCIONAL SIMPLIFICADO SOBRE INGRESOS', 'reg_desc_ct'=>'mensual',  'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['reg_descripcion' => 'SOBRE UTILIDADES LUCRATIVAS', 'reg_desc_ct'=>'trimestral',  'created_at' => Carbon::now()->format('Y-m-d H:i:s')]
        ]);
    }
}
