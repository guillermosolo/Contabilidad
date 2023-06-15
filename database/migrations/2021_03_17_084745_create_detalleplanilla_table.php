<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleplanillaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleplanilla', function (Blueprint $table) {
            $table->bigIncrements('detp_id');
            $table->unsignedBigInteger('detp_planilla');
            $table->foreign('detp_planilla','fk_detalllePlanilla_planilla')->references('pla_id')->on('planilla');
            $table->unsignedBigInteger('dept_empleado');
            $table->foreign('dept_empleado','fk_detallePlanilla_empleado')->references('empl_id')->on('empleados');
            $table->unsignedBigInteger('dept_tipo');
            $table->foreign('dept_tipo','fk_detallePlanilla_tipo')->references('tipd_id')->on('tipodesc');
            $table->unsignedDecimal('dept_monto',8,2);
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
        Schema::dropIfExists('detalleplanilla');
    }
}
