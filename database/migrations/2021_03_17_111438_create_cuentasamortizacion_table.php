<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentasamortizacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentasamortizacion', function (Blueprint $table) {
            $table->bigIncrements('cam_id');
            $table->date('cam_fecha');
            $table->unsignedBigInteger('cam_categoria');
            $table->foreign('cam_categoria','fk_ctaAmortizacion_categoria')->references('cat_id')->on('categoria');
            $table->unsignedBigInteger('cam_amort');
            $table->foreign('cam_amort','fk_cuentasAmortizaciones_cuentaContable')->references('cta_id')->on('cuentacontable');
            $table->unsignedBigInteger('cam_amortAcum');
            $table->foreign('cam_amortAcum','fk_CuentAmortizacion_cuentaContable')->references('cta_id')->on('cuentacontable');
            $table->unsignedDecimal('cam_monto',14,5);
            $table->unsignedDecimal('cam_inicial',14,5)->nullable();
            $table->unsignedDecimal('cam_porcentaje',7,5)->nullable();
            $table->string('cam_descripcion',100);
            $table->unsignedBigInteger('cam_empresa');
            $table->foreign('cam_empresa','fk_cuentasamortizacion_empresa')->references('emp_id')->on('empresa');
            $table->unsignedBigInteger('cam_terminal');
            $table->foreign('cam_terminal','fk_cuentasamortizacion_terminal')->references('ter_id')->on('terminal');
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
        Schema::dropIfExists('cuentasamortizacion');
    }
}
