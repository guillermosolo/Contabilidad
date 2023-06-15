<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrasladosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traslados', function (Blueprint $table) {
            $table->bigIncrements('tra_id');
            $table->date('tra_fecha');
            $table->unsignedBigInteger('tra_origen');
            $table->foreign('tra_origen','fk_traslados_terminal')->references('ter_id')->on('terminal');
            $table->unsignedBigInteger('tra_destino');
            $table->foreign('tra_destino','fk_traslados_terminal2')->references('ter_id')->on('terminal');
            $table->string('tra_descripcion',100);
            $table->boolean('tra_activo');
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
        Schema::dropIfExists('traslados');
    }
}
