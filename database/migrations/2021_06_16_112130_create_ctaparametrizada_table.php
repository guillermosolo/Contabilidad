<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCtaparametrizadaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ctaparametrizada', function (Blueprint $table) {
            $table->bigIncrements('par_id');
            $table->string('par_nombre');
            $table->unsignedBigInteger('par_cuentaContable');
            $table->foreign('par_cuentaContable','fk_parametrizadas_cuentacontable')->references('cta_id')->on('cuentacontable');
            $table->unsignedBigInteger('par_empresa');
            $table->foreign('par_empresa','fk_parametrizadas_empresa')->references('emp_id')->on('empresa');
            $table->unsignedBigInteger('par_terminal');
            $table->foreign('par_terminal','fk_parametrizadas_terminal')->references('ter_id')->on('terminal');
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
        Schema::dropIfExists('ctaparametrizada');
    }
}
