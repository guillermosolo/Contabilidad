<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ConceptosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conceptosretencion')->insert([
            ['conR_id' => 1, 'conR_descripcion' => 'Compras o Servicios Gravados, adquiridos de Entidades Exentas', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['conR_id' => 2, 'conR_descripcion' => 'Materias Primas', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['conR_id' => 3, 'conR_descripcion' => 'Productos Terminados', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['conR_id' => 4, 'conR_descripcion' => 'Transporte de carga y de personas dentro o fuera del territorio', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['conR_id' => 5, 'conR_descripcion' => 'Telecomunicaciones', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['conR_id' => 6, 'conR_descripcion' => 'Servicios Bancarios, Seguros y Financieros', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['conR_id' => 7, 'conR_descripcion' => 'Servicios Informáticos', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['conR_id' => 8, 'conR_descripcion' => 'Suministro de Energía Eléctrica y Agua', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['conR_id' => 9, 'conR_descripcion' => 'Servicios Técnicos', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['conR_id' => 10, 'conR_descripcion' => 'Arrendamiento y Subarrendamiento de Bienes Muebles', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['conR_id' => 11, 'conR_descripcion' => 'Arrendamiento y Subarrendamiento de Bienes Inmuebles', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['conR_id' => 12, 'conR_descripcion' => 'Servicios Profesionales', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['conR_id' => 13, 'conR_descripcion' => 'Dietas a asistentes eventuales a consejos y otros órganos directivos', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['conR_id' => 14, 'conR_descripcion' => 'Espectáculos Públicos, Culturales y Deportivos', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['conR_id' => 15, 'conR_descripcion' => 'Subsidios Públicos', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['conR_id' => 16, 'conR_descripcion' => 'Subsidios Privados', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['conR_id' => 17, 'conR_descripcion' => 'Otros Bienes y/o  Servicios', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['conR_id' => 18, 'conR_descripcion' => 'Películas Cinematográficas, TV y similares', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['conR_id' => 19, 'conR_descripcion' => 'Dietas', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['conR_id' => 20, 'conR_descripcion' => 'Otras Remuneraciones (Viáticos no comprobables, comisiones, Gastos de Representación)', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')]
        ]);
    }
}
