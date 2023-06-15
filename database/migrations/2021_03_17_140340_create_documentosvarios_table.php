<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosvariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentosvarios', function (Blueprint $table) {
            $table->bigIncrements('docv_id');
            $table->date('docv_fecha');
            $table->string('docv_formularioSAT',10);
            $table->string('docv_numero',25);
            $table->unsignedBigInteger('docv_persona');
            $table->unsignedDecimal('docv_monto',14,5);
            $table->unsignedBigInteger('docv_empresa');
            $table->foreign('docv_empresa','fk_documentosVarios_empresa')->references('emp_id')->on('empresa');
            $table->unsignedBigInteger('docv_terminal');
            $table->foreign('docv_terminal','fk_documentosVarios_terminal')->references('ter_id')->on('terminal');
            $table->unsignedBigInteger('docv_correlativoInt');
            $table->foreign('docv_correlativoInt','fk_documentosVarios_correlativoInt')->references('corr_id')->on('correlativoint');
            $table->string('docv_tipo',1);
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
        Schema::dropIfExists('documentosvarios');
    }
}
