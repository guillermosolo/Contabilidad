<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoRetencionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tiporetencion')->insert([
        [
            'tret_descripcion' => 'Adquisición Prod No Agrícolas y Pecuarias ó Servicio',
            'tret_tipo'=>'IVA',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tret_descripcion' => 'Contribuyentes especiales',
            'tret_tipo'=>'IVA',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tret_descripcion' => 'Sector Público',
            'tret_tipo'=>'IVA',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tret_descripcion' => 'Compras o Servicios gravados, adquiridos de Entidades Exentas que realizan actividades lucrativas ',
            'tret_tipo'=>'ISR',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tret_descripcion' => 'Materias Primas',
            'tret_tipo'=>'ISR',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tret_descripcion' => 'Productos Terminados',
            'tret_tipo'=>'ISR',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tret_descripcion' => 'Transporte (de carga y de personas dentro o fuera del territorio)',
            'tret_tipo'=>'ISR',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tret_descripcion' => 'Telecomunicaciones',
            'tret_tipo'=>'ISR',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tret_descripcion' => 'Servicios Bancarios, Seguros y Financieros',
            'tret_tipo'=>'ISR',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tret_descripcion' => 'Servicios Informáticos',
            'tret_tipo'=>'ISR',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tret_descripcion' => 'Suministro de Energía Eléctrica y Agua',
            'tret_tipo'=>'ISR',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tret_descripcion' => 'Servicios Técnicos',
            'tret_tipo'=>'ISR',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tret_descripcion' => 'Arrendamiento y Subarrendamiento de Bienes Muebles',
            'tret_tipo'=>'ISR',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tret_descripcion' => 'Arrendamiento y Subarrendamiento de Bienes Inmuebles',
            'tret_tipo'=>'ISR',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tret_descripcion' => 'Servicios Profesionales',
            'tret_tipo'=>'ISR',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tret_descripcion' => 'Dietas a asistentes eventuales a consejos y otros órganos directivos',
            'tret_tipo'=>'ISR',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tret_descripcion' => 'Espectáculos, Públicos, Culturales y Deportivos',
            'tret_tipo'=>'ISR',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tret_descripcion' => 'Subsidios Públicos',
            'tret_tipo'=>'ISR',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tret_descripcion' => 'Subsidios Privados',
            'tret_tipo'=>'ISR',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tret_descripcion' => 'Otros Bienes y/o Servicios',
            'tret_tipo'=>'ISR',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tret_descripcion' => 'Películas Cinematográficas, TV y Similares',
            'tret_tipo'=>'ISR',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tret_descripcion' => 'Dietas',
            'tret_tipo'=>'ISR',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'tret_descripcion' => 'Otras Remuneraciones (Viáticos no comprobables, Comisiones, Gastos de Representación)',
            'tret_tipo'=>'ISR',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]
        ]);
    }
}
