<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleretencionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleretencion', function (Blueprint $table) {
            $table->bigIncrements('detr_id');
            $table->unsignedBigInteger('detr_doc');
            $table->foreign('detr_doc','fk_detalleretencion_documentos varios')->references('docv_id')->on('documentosvarios');
            $table->unsignedBigInteger('detr_factura');
            $table->foreign('detr_factura','fk_detalleretencion_ventas')->references('ven_id')->on('ventas');
            $table->unsignedDecimal('detr_retencion',14,5);
            $table->unsignedBigInteger('detr_tiporetencion');
            $table->foreign('detr_tiporetencion','fk_tretencion_tiporetencion')->references('tret_id')->on('tiporetencion');
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
        Schema::dropIfExists('detalleretencion');
    }
}
