<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConciliacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conciliacion', function (Blueprint $table) {
            $table->bigIncrements('con_id');
            $table->unsignedSmallInteger('con_anio');
            $table->unsignedTinyInteger('con_mes');
            $table->decimal('con_saldo',14,5);
            $table->boolean('con_conciliado');
            $table->unsignedBigInteger('con_cuentabancaria');
            $table->foreign('con_cuentabancaria','fk_conciliacion_cuentabancaria')->references('ctab_id')->on('cuentabancaria');
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
        Schema::dropIfExists('conciliacion');
    }
}
