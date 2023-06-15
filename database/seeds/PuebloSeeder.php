<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\support\Facades\DB;

class PuebloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('pueblo')->insert([
        ['pue_id' => 1, 'pue_descripcion' => 'XINCA' ,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ['pue_id' => 2, 'pue_descripcion' => 'MAYA' ,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ['pue_id' => 3, 'pue_descripcion' => 'GARÍFUNA' ,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ['pue_id' => 4, 'pue_descripcion' => 'MESTIZA' ,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ['pue_id' => 5, 'pue_descripcion' => 'EXTRANJEROS' ,'created_at' => Carbon::now()->format('Y-m-d H:i:s')]
         ]);
    }
}
