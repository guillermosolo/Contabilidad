<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentabancariaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentabancaria', function (Blueprint $table) {
            $table->bigIncrements('ctab_id');
            $table->string('ctab_numero',25);
            $table->unsignedBigInteger('ctab_tipo');
            $table->foreign('ctab_tipo','fk_cuentabancaria_tipocuentabancaria')->references('tcb_id')->on('tipocuentabancaria');
            $table->unsignedBigInteger('ctab_banco');
            $table->foreign('ctab_banco','fk_cuentabancaria_banco')->references('ban_id')->on('bancos');
            $table->unsignedBigInteger('ctab_moneda');
            $table->foreign('ctab_moneda','fk_cuentabancaria_moneda')->references('mon_id')->on('moneda');
            $table->unsignedBigInteger('ctab_cuentacontable');
            $table->foreign('ctab_cuentacontable','fk_cuentabancaria_cuentacontable')->references('cta_id')->on('cuentacontable');
            $table->unsignedBigInteger('ctab_empresa');
            $table->foreign('ctab_empresa','fk_cuentabancaria_empresa')->references('emp_id')->on('empresa');
            $table->string('ctab_contacto',50)->nullable();
            $table->string('ctab_telefono',15)->nullable();
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
        Schema::dropIfExists('cuentabancaria');
    }
}
