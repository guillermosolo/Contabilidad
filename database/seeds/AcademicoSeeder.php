<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class AcademicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('academico')->insert([
            ['aca_id' =>0, 'aca_descripcion' => 'NINGUNO', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['aca_id' =>1, 'aca_descripcion' => 'INICIAL', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['aca_id' =>2, 'aca_descripcion' => 'PREPRIMARIA', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['aca_id' =>3, 'aca_descripcion' => 'PRIMARIA', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['aca_id' =>4, 'aca_descripcion' => 'BÁSICOS', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['aca_id' =>5, 'aca_descripcion' => 'DIVERSIFICADO', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['aca_id' =>6, 'aca_descripcion' => 'UNIVERSIDAD', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['aca_id' =>7, 'aca_descripcion' => 'MAESTRIA', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['aca_id' =>8, 'aca_descripcion' => 'DOCTORADO', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['aca_id' =>9, 'aca_descripcion' => 'NÚCLEOS FAMILIARES DE EDUCACIÓN', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['aca_id' =>10, 'aca_descripcion' => 'PROGRAMA DE EDUCACIÓN PARA ADULTOS', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['aca_id' =>11, 'aca_descripcion' => 'CENTROS MUNICIPALES DE CAPACITACIÓN Y FORMACIÓN', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['aca_id' =>13, 'aca_descripcion' => 'OTROS', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')]
        ]);
    }
}
