<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatusActivosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statusactivos')->insert([
            ['sta_descripcion'=>'ACTIVO','sta_baja'=>0,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['sta_descripcion'=>'BAJA POR DETERIORO','sta_baja'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['sta_descripcion'=>'BAJA POR VENTA','sta_baja'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]
        ]);
    }
}
