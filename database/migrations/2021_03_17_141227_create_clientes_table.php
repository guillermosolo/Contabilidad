<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('cli_id');
            $table->unsignedBigInteger('cli_persona');
            $table->foreign('cli_persona','fk_clientes_persona')->references('per_id')->on('personas');
            $table->unsignedBigInteger('cli_tipoCliente');
            $table->foreign('cli_tipoCliente','fk_clientes_tipopersona')->references('tpp_id')->on('tipopersona');
            $table->unsignedBigInteger('cli_credito')->nullable();
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
        Schema::dropIfExists('clientes');
    }
}
