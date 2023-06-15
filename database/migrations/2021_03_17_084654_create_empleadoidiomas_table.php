<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoidiomasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleadoidiomas', function (Blueprint $table) {
            $table->unsignedBigInteger('ei_empleado');
            $table->foreign('ei_empleado','fk_empleadoidiomas_empleados')->references('empl_id')->on('empleados');
            $table->unsignedInteger('ei_idioma');
            $table->foreign('ei_idioma','fk_empleadoidiomas_idioma')->references('idi_id')->on('idiomas');
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
        Schema::dropIfExists('empleadoidiomas');
    }
}
