<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarifasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarifas', function (Blueprint $table) {
            $table->unsignedBigInteger('tar_cliente');
            $table->foreign('tar_cliente','fk_tarifas_personas')->references('per_id')->on('personas');
            $table->unsignedBigInteger('tar_producto');
            $table->foreign('tar_producto','fk_tarifas_productos')->references('prod_id')->on('productos');
            $table->decimal('tar_tarifa',14,5);
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
        Schema::dropIfExists('tarifas');
    }
}
