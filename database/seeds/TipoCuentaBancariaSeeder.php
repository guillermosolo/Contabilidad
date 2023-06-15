<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TipoCuentaBancariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipocuentabancaria')->insert([
            ['tcb_descripcion'=>'MONETARIA','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['tcb_descripcion'=>'AHORROS','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]
        ]);
    }
}
