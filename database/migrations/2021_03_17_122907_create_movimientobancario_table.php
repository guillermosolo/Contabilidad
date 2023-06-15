<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientobancarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientobancario', function (Blueprint $table) {
            $table->bigIncrements('movb_id');
            $table->string('movb_descripcion',50);
            $table->unsignedBigInteger('movb_cuentacontable');
            $table->foreign('movb_cuentacontable','fk_movimeintobancario_cuentacontable')->references('cta_id')->on('cuentacontable');
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
        Schema::dropIfExists('movimientobancario');
    }
}
