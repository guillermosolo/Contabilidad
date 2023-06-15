<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleconciliacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleconciliacion', function (Blueprint $table) {
            $table->bigIncrements('dcon_linea');
            $table->unsignedBigInteger('dcon_conciliacion');
            $table->foreign('dcon_conciliacion','fk_detalle_conciliacion')->references('con_id')->on('conciliacion');
            $table->unsignedBigInteger('dcon_documento');
            $table->foreign('dcon_documento','fk_detalle_transaccionbancaria')->references('trab_id')->on('transaccionbancaria');
            $table->boolean('dcon_conciliado');
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
        Schema::dropIfExists('detalleconciliacion');
    }
}
