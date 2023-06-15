<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecibosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibos', function (Blueprint $table) {
            $table->bigIncrements('rec_id');
            $table->date('rec_fecha');
            $table->string('rec_nombre',100);
            $table->string('rec_descripcion',200);
            $table->string('rec_numDoc',25)->nullable();
            $table->decimal('rec_monto',14,5);
            $table->unsignedBigInteger('rec_moneda');
            $table->foreign('rec_moneda','fk_recibos_moneda')->references('mon_id')->on('moneda');
            $table->decimal('rec_tipoCambio',14,5);
            $table->unsignedBigInteger('rec_tipoGasto');
            $table->foreign('rec_tipoGasto','fk_recibos_cuentacontable')->references('cta_id')->on('cuentacontable');
            $table->unsignedBigInteger('rec_empresa');
            $table->foreign('rec_empresa','fk_recibos_empresa')->references('emp_id')->on('empresa');
            $table->unsignedBigInteger('rec_terminal');
            $table->foreign('rec_terminal','fk_recibos_terminal')->references('ter_id')->on('terminal');
            $table->unsignedBigInteger('rec_correlativoInt');
            $table->foreign('rec_correlativoInt','fk_recibos_correlativoint')->references('corr_id')->on('correlativoint');
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
        Schema::dropIfExists('recibos');
    }
}
