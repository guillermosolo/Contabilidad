<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RepresentanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('representante')->insert([
            ['repr_nombre'=>'Carlos Enrique Per Arriaga','repr_NIT'=>'32684487','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['repr_nombre'=>'Jenifer Sarai Urizar Velasquez','repr_NIT'=>'87600544','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['repr_nombre'=>'Silvia María Castillo Ariza','repr_NIT'=>'13649671','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['repr_nombre'=>'Williams Daniel Molina Rodriguez','repr_NIT'=>'80059430','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['repr_nombre'=>'Susana Noemí García Espel','repr_NIT'=>'85450103','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['repr_nombre'=>'Carolina Elizabeth Reyes Arriola','repr_NIT'=>'','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['repr_nombre'=>'Marcia María Reyes Arriola','repr_NIT'=>'','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['repr_nombre'=>'Nohe Jonatan Vasquez Orozco','repr_NIT'=>'','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['repr_nombre'=>'Juan José Pirir Castillo','repr_NIT'=>'','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['repr_nombre'=>'Jorge Luis Morataya Benitez','repr_NIT'=>'64791629','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['repr_nombre'=>'Cindy María Oliva Juárez','repr_NIT'=>'71421548','created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
        ]);
    }
}
