<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleturnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleturnos', function (Blueprint $table) {
            $table->bigIncrements('dett_id');
            $table->integer('dett_turnos');
            $table->integer('dett_extras')->nullable();
            $table->integer('dett_ordinales')->nullable();
            $table->unsignedBigInteger('dett_reporte');
            $table->foreign('dett_reporte','fk_detalle_reporteturnos')->references('rept_id')->on('reporteturnos');
            $table->unsignedBigInteger('dett_empleado');
            $table->foreign('dett_empleado','fk_detalle_empleados')->references('empl_id')->on('empleados');
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
        Schema::dropIfExists('detalleturnos');
    }
}
