<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCajachicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cajachica', function (Blueprint $table) {
            $table->bigIncrements('cch_id');
            $table->string('cch_nombre',50);
            $table->unsignedBigInteger('cch_responsable');
            $table->foreign('cch_responsable','fk_responsable_empleado')->references('empl_id')->on('empleados');
            $table->unsignedBigInteger('cch_cuentacontable');
            $table->foreign('cch_cuentacontable','fk_cajachica_cuentacontable')->references('cta_id')->on('cuentacontable');
            $table->unsignedBigInteger('cch_empresa');
            $table->foreign('cch_empresa','fk_cajachica_empresa')->references('emp_id')->on('empresa');
            $table->unsignedDecimal('cch_monto',14,5);
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
        Schema::dropIfExists('cajachica');
    }
}
