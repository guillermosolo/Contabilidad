<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Parametros\Empresa;

class RepresentacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $empresa=Empresa::find(1);
        $empresa->Representantes()->attach(8,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>1,'rep_constancia'=>'S/N']);
        $empresa->Representantes()->attach(6,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>1,'rep_constancia'=>'S/N']);
        $empresa->Representantes()->attach(4,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>2,'rep_constancia'=>'S/N']);
        $empresa=Empresa::find(2);
        $empresa->Representantes()->attach(8,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>1,'rep_constancia'=>'S/N']);
        $empresa->Representantes()->attach(6,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>1,'rep_constancia'=>'S/N']);
        $empresa->Representantes()->attach(5,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>2,'rep_constancia'=>'S/N']);
        $empresa=Empresa::find(3);
        $empresa->Representantes()->attach(8,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>1,'rep_constancia'=>'S/N']);
        $empresa->Representantes()->attach(6,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>1,'rep_constancia'=>'S/N']);
        $empresa->Representantes()->attach(3,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>2,'rep_constancia'=>'S/N']);
        $empresa=Empresa::find(4);
        $empresa->Representantes()->attach(8,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>1,'rep_constancia'=>'S/N']);
        $empresa->Representantes()->attach(5,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>2,'rep_constancia'=>'S/N']);
        $empresa=Empresa::find(5);
        $empresa->Representantes()->attach(6,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>1,'rep_constancia'=>'S/N']);
        $empresa->Representantes()->attach(8,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>1,'rep_constancia'=>'S/N']);
        $empresa->Representantes()->attach(10,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>2,'rep_constancia'=>'S/N']);
        $empresa=Empresa::find(6);
        $empresa->Representantes()->attach(6,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>1,'rep_constancia'=>'S/N']);
        $empresa->Representantes()->attach(10,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>2,'rep_constancia'=>'S/N']);
        $empresa=Empresa::find(7);
        $empresa->Representantes()->attach(8,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>1,'rep_constancia'=>'S/N']);
        $empresa->Representantes()->attach(6,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>1,'rep_constancia'=>'S/N']);
        $empresa->Representantes()->attach(1,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>2,'rep_constancia'=>'S/N']);
        $empresa=Empresa::find(8);
        $empresa->Representantes()->attach(9,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>1,'rep_constancia'=>'S/N']);
        $empresa->Representantes()->attach(11,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>2,'rep_constancia'=>'S/N']);
        $empresa=Empresa::find(9);
        $empresa->Representantes()->attach(2,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>1,'rep_constancia'=>'S/N']);
        $empresa->Representantes()->attach(1,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>2,'rep_constancia'=>'S/N']);
        $empresa=Empresa::find(10);
        $empresa->Representantes()->attach(8,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>1,'rep_constancia'=>'S/N']);
        $empresa->Representantes()->attach(2,['rep_inicio'=>Carbon::now()->format('Y-m-d H:i:s'),'rep_tipo'=>2,'rep_constancia'=>'S/N']);
    }
}
