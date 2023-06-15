<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsableactivoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsableactivo', function (Blueprint $table) {
            $table->bigIncrements('rac_id');
            $table->unsignedBigInteger('rac_activo');
            $table->foreign('rac_activo','fk_responsableActivo_activo')->references('act_id')->on('activos');
            $table->unsignedBigInteger('rac_empleado');
            $table->foreign('rac_empleado','fk_responsableActivo_empleado')->references('empl_id')->on('empleados');
            $table->date('rac_inicio');
            $table->date('rac_fin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('responsableactivo');
    }
}
