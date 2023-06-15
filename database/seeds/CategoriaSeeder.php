<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria')->insert([
            ['cat_descripcion' => 'EDIFICIOS E INMUEBLES', 'cat_porcentaje' => 0.0500, 'cat_tipo' => 'D','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['cat_descripcion' => 'ARBOLES, ARBUSTOS Y FRUTALES', 'cat_porcentaje' => 0.1500, 'cat_tipo' => 'D','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['cat_descripcion' => 'MOBILIARIO Y EQUIPO', 'cat_porcentaje' => 0.2000, 'cat_tipo' => 'D','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['cat_descripcion' => 'VEHÍCULOS', 'cat_porcentaje' => 0.2000, 'cat_tipo' => 'D','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['cat_descripcion' => 'MAQUINARIA', 'cat_porcentaje' => 0.2000, 'cat_tipo' => 'D','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['cat_descripcion' => 'EQUIPO DE COMPUTACIÓN', 'cat_porcentaje' => 0.3333, 'cat_tipo' => 'D','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['cat_descripcion' => 'HERRAMIENTAS', 'cat_porcentaje' => 0.2500, 'cat_tipo' => 'D','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['cat_descripcion' => 'EDIFICIOS E INMUEBLES', 'cat_porcentaje' => 0.0500, 'cat_tipo' => 'D','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['cat_descripcion' => 'DERECHOS DE AUTOR', 'cat_porcentaje' => 0.2000, 'cat_tipo' => 'A','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['cat_descripcion' => 'MARCAS', 'cat_porcentaje' => 0.2000, 'cat_tipo' => 'A','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['cat_descripcion' => 'PATENTES', 'cat_porcentaje' => 0.2000, 'cat_tipo' => 'A','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['cat_descripcion' => 'GASTOS DE ORGANIZAICÓN', 'cat_porcentaje' => 0.2000, 'cat_tipo' => 'A','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['cat_descripcion' => 'DERECHO DE LLAVE', 'cat_porcentaje' => 0.1000, 'cat_tipo' => 'A','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
        ]);
    }
}
