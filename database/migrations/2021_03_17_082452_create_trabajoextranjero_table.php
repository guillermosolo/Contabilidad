<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabajoextranjeroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajoextranjero', function (Blueprint $table) {
            $table->bigIncrements('trex_id');
            $table->unsignedBigInteger('trex_empleado');
            $table->foreign('trex_empleado','fk_trabajoex_empleados')->references('empl_id')->on('empleados');
            $table->string('trex_ocupacion',4);
            $table->unsignedInteger('trex_pais');
            $table->foreign('trex_pais','fk_trabajoex_paises')->references('pai_id')->on('paises');
            $table->string('trex_motivo',50);
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
        Schema::dropIfExists('trabajoextranjero');
    }
}
