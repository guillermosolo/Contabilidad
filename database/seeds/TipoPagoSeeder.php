<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipopago')->insert([
            ['tip_nombre'=>'EFECTIVO','tip_referencia'=>0,'tip_tabla'=>'N','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['tip_nombre'=>'RETENCION ISR','tip_referencia'=>1,'tip_tabla'=>'V','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
        ]);
    }
}
