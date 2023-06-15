<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosproveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagosproveedores', function (Blueprint $table) {
            $table->bigIncrements('pap_id');
            $table->unsignedBigInteger('pap_documento');
            $table->unsignedDecimal('pap_monto',14,5);
            $table->unsignedBigInteger('pap_tipoPago');
            $table->foreign('pap_tipoPago','fk_pagosprov_tipoPago')->references('tip_id')->on('tipopago');
            $table->unsignedBigInteger('pap_referencia');
            $table->date('pap_fecha');
            $table->string('pap_tipoDoc',1);
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
        Schema::dropIfExists('pagosproveedores');
    }
}
