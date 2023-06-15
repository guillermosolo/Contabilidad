<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleventasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleventas', function (Blueprint $table) {
            $table->bigIncrements('detv_id');
            $table->unsignedBigInteger('detv_venta');
            $table->foreign('detv_venta','fk_detalle_ventas')->references('ven_id')->on('ventas');
            $table->unsignedBigInteger('detv_producto');
            $table->foreign('detv_producto','fk_detalle_producto')->references('prod_id')->on('productos');
            $table->decimal('detv_precioU',14,5);
            $table->decimal('detv_cantidad',14,5);
            $table->decimal('detv_descuento',14,5)->nullable();
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
        Schema::dropIfExists('detalleventas');
    }
}
