<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReporteAusenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reporteausencia', function (Blueprint $table) {
            $table->increments('rea_id');
            $table->unsignedBigInteger('rea_empleado');
            $table->date('rea_inicio');
            $table->date('rea_fin')->nullable();
            $table->string('rea_observaciones',100);
            $table->foreign('rea_empleado','fk_reporteausencia_empleado')->references('empl_id')->on('empleados');
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
        Schema::dropIfExists('reporteausencia');
    }
}
