<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('moneda')->insert([
            ['mon_nombre' => 'QUETZAL', 'mon_abreviatura' => 'GTQ', 'mon_simbolo' => 'Q', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['mon_nombre' => 'DOLAR', 'mon_abreviatura' => 'USD', 'mon_simbolo' => '$', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')]
        ]);
    }
}
