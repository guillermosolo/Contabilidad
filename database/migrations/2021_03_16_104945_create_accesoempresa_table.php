<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccesoempresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesoempresa', function (Blueprint $table) {
            $table->unsignedBigInteger('acce_usuario');
            $table->foreign('acce_usuario','fk_accesoempresa_usuario')->references('id')->on('usuario');
            $table->unsignedBigInteger('acce_empresa');
            $table->foreign('acce_empresa','fk_accesoempresa_empresa')->references('emp_id')->on('empresa');
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
        Schema::dropIfExists('accesoempresa');
    }
}
