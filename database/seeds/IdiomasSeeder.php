<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IdiomasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('idiomas')->insert([
            ['idi_id' => 1, 'idi_descripcion' => "ACHI'", 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 2, 'idi_descripcion' => 'AKATEKO', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 3, 'idi_descripcion' => 'AWAKATEKO', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 4, 'idi_descripcion' => "CH'ORTI'", 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 5, 'idi_descripcion' => 'CHUJ', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 6, 'idi_descripcion' => 'ITZÁ', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 7, 'idi_descripcion' => 'IXIL', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 8, 'idi_descripcion' => 'JAKALTECO', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 9, 'idi_descripcion' => 'KAQCHIKEL', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 10, 'idi_descripcion' => "K'ICHE'", 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 11, 'idi_descripcion' => 'MAM', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 12, 'idi_descripcion' => 'MOPAN', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 13, 'idi_descripcion' => 'POQOMAN', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 14, 'idi_descripcion' => "POQOMCHI'", 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 15, 'idi_descripcion' => "Q'ANJOB'AL", 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 16, 'idi_descripcion' => "Q'EQCHI", 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 17, 'idi_descripcion' => 'SAKAPULTEKO', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 18, 'idi_descripcion' => 'SIPAKAPENSE', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 19, 'idi_descripcion' => 'TEKTITECO', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 20, 'idi_descripcion' => "TZ'UTUJIL", 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 21, 'idi_descripcion' => 'USPANTEKO', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 22, 'idi_descripcion' => 'GARIFUNA', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 23, 'idi_descripcion' => 'ESPAÑOL', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 24, 'idi_descripcion' => 'INGLES', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 25, 'idi_descripcion' => 'FRANCES', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 26, 'idi_descripcion' => 'ALEMAN', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 27, 'idi_descripcion' => 'ITALIANO', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 28, 'idi_descripcion' => 'COREANO', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 29, 'idi_descripcion' => 'JAPONES', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 30, 'idi_descripcion' => 'MANDARIN', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 31, 'idi_descripcion' => 'CANTONÉS', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 32, 'idi_descripcion' => 'TAILANDÉS', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 33, 'idi_descripcion' => 'PORTUGUÉS', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 34, 'idi_descripcion' => 'ARABE', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 35, 'idi_descripcion' => 'HEBREO', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 36, 'idi_descripcion' => 'GRIEGO', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 37, 'idi_descripcion' => 'NEERLANDÉS', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['idi_id' => 38, 'idi_descripcion' => 'OTROS', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ]);
    }
}
