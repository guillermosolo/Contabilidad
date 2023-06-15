<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbonosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonos', function (Blueprint $table) {
            $table->bigIncrements('abf_id');
            $table->unsignedBigInteger('abf_venta');
            $table->foreign('abf_venta','fk_abonos_ventas')->references('ven_id')->on('ventas');
            $table->decimal('abf_monto',14,5);
            $table->unsignedBigInteger('abf_tipoAbono');
            $table->foreign('abf_tipoAbono','fk_abonos_tipopago')->references('tip_id')->on('tipopago');
            $table->unsignedBigInteger('abf_referencia')->nullable();
            $table->date('abf_fecha');
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
        Schema::dropIfExists('abonos');
    }
}
