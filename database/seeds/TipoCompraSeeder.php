<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TipoCompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipocompra')->insert([
            ['tipc_descripcion'=>'COMPRA','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['tipc_descripcion'=>'SERVICIO','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['tipc_descripcion'=>'COMBUSTIBLE','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
        ]);
    }
}
