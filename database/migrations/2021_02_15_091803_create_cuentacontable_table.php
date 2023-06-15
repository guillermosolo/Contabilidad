<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentacontableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentacontable', function (Blueprint $table) {
            $table->bigIncrements('cta_id');
            $table->string('cta_codigo',8);
            $table->string('cta_descripcion',100);
            $table->unsignedBigInteger('cta_padre');
            $table->boolean('cta_detalle');
            $table->unsignedBigInteger('cta_centroCosto');
            $table->foreign('cta_centroCosto','fk_cuentaContable_centrocosto')->references('cco_id')->on('centrocosto');
            $table->string('cta_tipoSaldo',1);
            $table->boolean('cta_excento')->nullable();
            $table->string('cta_obs1',5)->nullable();
            $table->string('cta_obs2',5)->nullable();
            $table->string('cta_obs3',5)->nullable();
            $table->unsignedBigInteger('cta_empresa');
            $table->foreign('cta_empresa','fk_cuentaContable_empresa')->references('emp_id')->on('empresa');
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
        Schema::dropIfExists('cuentacontable');
    }
}
