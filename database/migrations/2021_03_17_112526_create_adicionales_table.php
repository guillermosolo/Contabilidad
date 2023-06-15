<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdicionalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adicionales', function (Blueprint $table) {
            $table->bigIncrements('adi_id');
            $table->unsignedBigInteger('adi_propiedad');
            $table->foreign('adi_propiedad','fk_adicionales_propiedad')->references('prop_id')->on('propiedad');
            $table->string('adi_valor',50);
            $table->unsignedBigInteger('adi_activo');
            $table->foreign('adi_activo','fk_adicionales_activos')->references('act_id')->on('activos');
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
        Schema::dropIfExists('adicionales');
    }
}
