<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallepolizaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detallepoliza', function (Blueprint $table) {
            $table->bigIncrements('detp_id');
            $table->unsignedBigInteger('detp_poliza');
            $table->foreign('detp_poliza','fk_detalle_poliza')->references('poim_id')->on('polizasimportacion');
            $table->decimal('detp_cantidad',14,5);
            $table->string('detp_descripcion',100);
            $table->decimal('detp_fob',14,5);
            $table->decimal('detp_flete',14,5);
            $table->decimal('detp_seguro',14,5);
            $table->decimal('detp_IVA',14,5);
            $table->unsignedBigInteger('detp_tipoGasto');
            $table->foreign('detp_tipoGasto','fk_detalle_cuentacontable')->references('cta_id')->on('cuentacontable');
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
        Schema::dropIfExists('detallepoliza');
    }
}
