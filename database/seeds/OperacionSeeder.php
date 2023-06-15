<?php

use Illuminate\Database\Seeder;
use App\Models\Parametros\Empresa;

class OperacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::find(1)->Terminales()->attach([1,2,3,99]);
        Empresa::find(2)->Terminales()->attach([1,2,3,4,99]);
        Empresa::find(3)->Terminales()->attach([1,3,99]);
        Empresa::find(4)->Terminales()->attach([4,99]);
        Empresa::find(5)->Terminales()->attach([1,7,99]);
        Empresa::find(6)->Terminales()->attach([1,4,99]);
        Empresa::find(7)->Terminales()->attach([1,2,4,5,7,99]);
        Empresa::find(8)->Terminales()->attach([1,4,99]);
        Empresa::find(9)->Terminales()->attach([6,99]);
        Empresa::find(10)->Terminales()->attach([1,2,3,99]);
    }
}
