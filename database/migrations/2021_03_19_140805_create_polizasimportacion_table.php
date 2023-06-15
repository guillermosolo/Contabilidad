<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolizasimportacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polizasimportacion', function (Blueprint $table) {
            $table->bigIncrements('poim_id');
            $table->date('poim_fecha');
            $table->string('poim_proveedor',100);
            $table->string('poim_descripcion',200);
            $table->string('poim_orden',15);
            $table->string('poim_dua',25);
            $table->unsignedBigInteger('poim_moneda');
            $table->foreign('poim_moneda','fk_polizasimportacion_moneda')->references('mon_id')->on('moneda');
            $table->unsignedDecimal('poim_tipoCambio',14,5);
            $table->unsignedDecimal('poim_FOB',14,5);
            $table->unsignedDecimal('poim_flete',14,5);
            $table->unsignedDecimal('poim_seguro',14,5);
            $table->unsignedDecimal('poim_IVA',14,5);
            $table->unsignedBigInteger('poim_empresa');
            $table->foreign('poim_empresa','fk_polizasimportacion_empresa')->references('emp_id')->on('empresa');
            $table->unsignedBigInteger('poim_terminal');
            $table->foreign('poim_terminal','fk_polizasimpotacion_terminal')->references('ter_id')->on('terminal');
            $table->unsignedBigInteger('poim_correlativoInt');
            $table->foreign('poim_correlativoInt','fk_polizasimportacion_correlativoint')->references('corr_id')->on('correlativoint');
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
        Schema::dropIfExists('polizasimportacion');
    }
}
