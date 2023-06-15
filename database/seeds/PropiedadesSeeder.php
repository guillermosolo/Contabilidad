<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PropiedadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('propiedad')->insert([
            ['prop_nombre'=>'COLOR','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['prop_nombre'=>'MOTOR','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['prop_nombre'=>'CHASSIS','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['prop_nombre'=>'CPU','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['prop_nombre'=>'MEMORIA','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['prop_nombre'=>'MARCA','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['prop_nombre'=>'ESTILO','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['prop_nombre'=>'MODELO','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ]);
    }
}
