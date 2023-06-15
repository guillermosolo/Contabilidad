<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReporteturnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reporteturnos', function (Blueprint $table) {
            $table->bigIncrements('rept_id');
            $table->date('rept_fecha');
            $table->string('rept_nombreBuque',50)->nullable();
            $table->unsignedSmallInteger('rept_turno');
            $table->string('rept_bodegas',50);
            $table->dateTime('rept_inicio');
            $table->dateTime('rept_fin')->nullable();
            $table->unsignedDecimal('rept_produccion',8,2);
            $table->unsignedBigInteger('rept_planilla');
            $table->foreign('rept_planilla','fk_reporteturnos_planilla')->references('pla_id')->on('planilla');
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
        Schema::dropIfExists('reporteturnos');
    }
}
