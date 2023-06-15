<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operacion', function (Blueprint $table) {
            $table->unsignedBigInteger('ope_empresa');
            $table->foreign('ope_empresa','fk_operacion_empresa')->references('emp_id')->on('empresa');
            $table->unsignedBigInteger('ope_terminal');
            $table->foreign('ope_terminal','fk_operacion_terminal')->references('ter_id')->on('terminal');
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
        Schema::dropIfExists('operacion');
    }
}
