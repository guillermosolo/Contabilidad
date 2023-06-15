<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CertificadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('certificador')->insert([
            [
                'cer_nombre' => 'PAPEL',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'cer_nombre' => 'SAT',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'cer_nombre' => 'INFILE',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
