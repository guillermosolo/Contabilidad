<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleanticipoTable extends Migration
{

    public function up()
    {
        Schema::create('detalleanticipo', function (Blueprint $table) {
            $table->bigIncrements('dant_linea');
            $table->unsignedBigInteger('dant_anticipo');
            $table->foreign('dant_anticipo','fk_detalle_anticipo')->references('ant_id')->on('anticipo');
            $table->unsignedBigInteger('dant_tipo');
            $table->foreign('dant_tipo','fk_detalle_movimientobancario')->references('movb_id')->on('movimientobancario');
            $table->string('dant_documento',15)->nullable();
            $table->decimal('dant_monto',14,5);
            $table->string('dant_estado',1);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('detalleanticipo');
    }
}
