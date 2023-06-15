<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlseguridadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controlseguridad', function (Blueprint $table) {
            $table->bigIncrements('cons_id');
            $table->date('cons_fecha');
            $table->unsignedBigInteger('cons_empleado');
            $table->foreign('cons_empleado','fk_controlSeguridad_empleado')->references('empl_id')->on('empleados');
            $table->dateTime('cons_ingreso')->nullable();
            $table->dateTime('cons_salida')->nullable();
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
        Schema::dropIfExists('controlseguridad');
    }
}
