<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BancosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bancos')->insert([[
            'ban_nombre'=>'Banco Industrial S.A',
            'ban_siglas'=>'BI',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'ban_nombre'=>'Banco de Desarrollo Rural, S.A.',
            'ban_siglas'=>'BANRURAL',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'ban_nombre'=>'InterBanco',
            'ban_siglas'=>'INTER',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s')

        ]]);
    }
}
