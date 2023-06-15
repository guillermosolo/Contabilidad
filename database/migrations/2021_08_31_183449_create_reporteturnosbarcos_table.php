<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReporteturnosbarcosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reporteturnosbarcos', function (Blueprint $table) {
            $table->increments('retb_id');
            $table->date('retb_inicio');
            $table->date('retb_fin');
            $table->integer('retb_turnos');
            $table->integer('retb_extras')->nullable();
            $table->integer('retb_ordinales')->nullable();
            $table->unsignedBigInteger('retb_planilla');
            $table->foreign('retb_planilla','fk_reporteturnosbarcos_planilla')->references('pla_id')->on('planilla');
            $table->unsignedBigInteger('retb_empleado');
            $table->foreign('retb_empleado','fk_reporteturnosbarcos_empleado')->references('empl_id')->on('empleados');
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
        Schema::dropIfExists('reporteturnosbarcos');
    }
}
