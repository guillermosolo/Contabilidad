<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenfacturacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenfacturacion', function (Blueprint $table) {
            $table->bigIncrements('ordf_id');
            $table->date('ordf_eta')->nullable();
            $table->string('ordf_buque',100)->nullable();
            $table->string('ordf_viaje',200)->nullable();
            $table->string('ordf_descripcion',200)->nullable();
            $table->decimal('ordf_total',14,5)->nullable();
            $table->unsignedBigInteger('ordf_cliente');
            $table->foreign('ordf_cliente','fk_ordenfacturacion_cliente')->references('per_id')->on('personas');
            $table->unsignedBigInteger('ordf_moneda');
            $table->foreign('ordf_moneda','fk_ordenFacturacion_moneda')->references('mon_id')->on('moneda');
            $table->decimal('ordf_tipoCambio',14,5)->nullable();
            $table->unsignedBigInteger('ordf_factura')->nullable();
            $table->unsignedBigInteger('ordf_empresa');
            $table->foreign('ordf_empresa','fk_ordenFacturacion_empresa')->references('emp_id')->on('empresa');
            $table->unsignedBigInteger('ordf_terminal');
            $table->foreign('ordf_terminal','fk_ordenFacturacion_terminal')->references('ter_id')->on('terminal');
            $table->unsignedBigInteger('ordf_correlativoInt');
            $table->foreign('ordf_correlativoInt','fk_ordenfacturacion_correlativoInt')->references('corr_id')->on('correlativoint');
            $table->boolean('ordf_anulada')->default(1);
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
        Schema::dropIfExists('ordenfacturacion');
    }
}
