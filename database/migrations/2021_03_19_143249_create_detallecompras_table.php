<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallecomprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detallecompras', function (Blueprint $table) {
            $table->bigIncrements('detc_id');
            $table->unsignedBigInteger('detc_documento');
            $table->foreign('detc_documento','fk_detallecompras_compras')->references('com_id')->on('compras');
            $table->string('detc_descripcion',100);
            $table->unsignedDecimal('detc_precioU',14,5);
            $table->unsignedDecimal('detc_cantidad',14,5);
            $table->unsignedBigInteger('detc_tipoGasto');
            $table->foreign('detc_tipoGasto','fk_detalleCompras_Cuentacontable')->references('cta_id')->on('cuentacontable');
            $table->unsignedBigInteger('detc_tipoComb')->nullable();
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
        Schema::dropIfExists('detallecompras');
    }
}
