<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolizasAutomaticasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automaticas', function (Blueprint $table) {
            $table->bigIncrements('aut_id');
            $table->string('aut_codigo',10);
            $table->unsignedBigInteger('aut_ctaContable');
            $table->foreign('aut_ctaContable','fk_automaticas_ctacontable')->references('cta_id')->on('cuentacontable');
            $table->unsignedBigInteger('aut_empresa');
            $table->foreign('aut_empresa','fk_automaticas_empresa')->references('emp_id')->on('empresa');
            $table->unsignedBigInteger('aut_terminal');
            $table->foreign('aut_terminal','fk_automaticas_terminal')->references('ter_id')->on('terminal');
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
        Schema::dropIfExists('automaticas');
    }
}
