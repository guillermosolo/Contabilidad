<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoDescSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        // Clase tipo S es salario, A aguinaldo, N bono 14 , E horas extras, T turnos, O Horas ordinarias, L dias laborados, U descuento Eventual
        DB::table('tipodesc')->insert([
            ['tipd_descripcion' => 'BONIFICACION INCENTIVO', 'tipd_forma' => 'F', 'tipd_clase' => 'B', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['tipd_descripcion' => 'Descuento Eventual', 'tipd_forma' => 'F', 'tipd_clase' => 'U', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['tipd_descripcion' => 'Salario', 'tipd_forma' => 'F', 'tipd_clase' => 'S', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['tipd_descripcion' => 'Aguinaldo', 'tipd_forma' => 'F', 'tipd_clase' => 'A', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['tipd_descripcion' => 'Bono 14', 'tipd_forma' => 'F', 'tipd_clase' => 'N', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['tipd_descripcion' => 'Horas Extras', 'tipd_forma' => 'F', 'tipd_clase' => 'E', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['tipd_descripcion' => 'Dias Lab', 'tipd_forma' => 'F', 'tipd_clase' => 'L', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['tipd_descripcion' => 'Turnos', 'tipd_forma' => 'F', 'tipd_clase' => 'T', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['tipd_descripcion' => 'Horas Ordinales', 'tipd_forma' => 'F', 'tipd_clase' => 'O', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['tipd_descripcion' => 'Septimo', 'tipd_forma' => 'F', 'tipd_clase' => 'P', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],

        ]);

    }
}
