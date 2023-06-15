<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnticipoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anticipo', function (Blueprint $table) {
            $table->bigIncrements('ant_id');
            $table->string('ant_numero',50);
            $table->date('ant_fecha');
            $table->boolean('ant_liquidado');
            $table->unsignedBigInteger('ant_cheque');
            $table->foreign('ant_cheque','fk_cheque_anticipo')->references('che_id')->on('cheque');
            $table->unsignedBigInteger('ant_proveedor')->nullable();
            $table->foreign('ant_proveedor','fk_anticipo_proveedor')->references('pro_id')->on('proveedores');
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
        Schema::dropIfExists('anticipo');
    }
}
