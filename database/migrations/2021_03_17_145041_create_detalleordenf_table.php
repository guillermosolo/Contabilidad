<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleordenfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleordenf', function (Blueprint $table) {
            $table->bigIncrements('dof_id');
            $table->unsignedBigInteger('dof_ordenF');
            $table->foreign('dof_ordenF','fk_detalleOrdenF_ordenFacturacion')->references('ordf_id')->on('ordenfacturacion');
            $table->unsignedBigInteger('dof_producto');
            $table->foreign('dof_producto','fk_detalleOrdenF_producto')->references('prod_id')->on('productos');
            $table->unsignedDecimal('dof_tarifa',14,5);
            $table->unsignedDecimal('dof_cantidad',14,5);
            $table->unsignedDecimal('dof_totcontenedor',14,5)->nullable();
            $table->unsignedDecimal('dof_civa',14,5)->nullable();
            $table->unsignedDecimal('dof_totaliva',14,5)->nullable();
            $table->unsignedDecimal('dof_totaldolar',14,5)->nullable();
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
        Schema::dropIfExists('detalleordenf');
    }
}
