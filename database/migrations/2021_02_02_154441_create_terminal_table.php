<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerminalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terminal', function (Blueprint $table) {
            $table->unsignedBigInteger('ter_id');
            $table->string('ter_nombre',25);
            $table->string('ter_abreviatura',2)->nullable();
            $table->string('ter_municipio',8);
            $table->foreign('ter_municipio','fk_terminal_depmun')->references('dep_id')->on('depmun');
            $table->boolean('ter_activo')->default(1);
            $table->string('ter_autoriza',50);
            $table->primary('ter_id');
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
        Schema::dropIfExists('terminal');
    }
}
