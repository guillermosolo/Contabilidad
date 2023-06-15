<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->bigIncrements('com_id');
            $table->date('com_fecha');
            $table->unsignedBigInteger('com_persona');
            $table->foreign('com_persona','fk_compras_personas')->references('per_id')->on('personas');
            $table->string('com_numDoc',100);
            $table->string('com_serie',100);
            $table->string('com_descripcion',200);
            $table->unsignedDecimal('com_monto',14,5);
            $table->unsignedBigInteger('com_tipo');
            $table->foreign('com_tipo','fk_compras_tipocompra')->references('tipc_id')->on('tipocompra');
            $table->boolean('com_retencion');
            $table->boolean('com_peqcontribuyente');
            $table->unsignedBigInteger('com_mesReportar');
            $table->unsignedDecimal('com_excento',14,5)->nullable();
            $table->unsignedBigInteger('com_ctaExcento');
            $table->foreign('com_ctaExcento','fk_Compras_Cuentacontable')->references('cta_id')->on('cuentacontable');
            $table->boolean('com_anulada')->default(0);
            $table->unsignedBigInteger('com_empresa');
            $table->foreign('com_empresa','fk_compras_empresa')->references('emp_id')->on('empresa');
            $table->unsignedBigInteger('com_terminal');
            $table->foreign('com_terminal','fk_compras_terminal')->references('ter_id')->on('terminal');
            $table->unsignedBigInteger('com_correlativoInt');
            $table->foreign('com_correlativoInt','fk_compras_correlativoInt')->references('corr_id')->on('correlativoint');
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
        Schema::dropIfExists('compras');
    }
}
