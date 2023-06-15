<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolizafacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polizafactura', function (Blueprint $table) {
            $table->unsignedBigInteger('polf_poliza');
            $table->foreign('polf_poliza','fk_polizafactura_polizaimportacion')->references('poim_id')->on('polizasimportacion');
            $table->unsignedBigInteger('polf_factura');
            $table->foreign('polf_factura','fk_polizafactura_compras')->references('com_id')->on('compras');
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
        Schema::dropIfExists('polizafactura');
    }
}
