<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\support\Facades\DB;

class DiscapacidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discapacidad')->insert([
            ['dis_id' => 1, 'dis_descripcion' => 'FÍSICA/MOTORA' ,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['dis_id' => 2, 'dis_descripcion' => 'INTELECTUAL' ,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['dis_id' => 3, 'dis_descripcion' => 'SENSORIAL' ,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['dis_id' => 4, 'dis_descripcion' => 'TALLA Y PESO' ,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['dis_id' => 5, 'dis_descripcion' => 'GENÉTICA' ,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['dis_id' => 6, 'dis_descripcion' => 'CONGÉNITA' ,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['dis_id' => 7, 'dis_descripcion' => 'NO APLICA' ,'created_at' => Carbon::now()->format('Y-m-d H:i:s')]
        ]);
    }
}
