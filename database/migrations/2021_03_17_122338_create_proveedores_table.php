<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->bigIncrements('pro_id');
            $table->unsignedBigInteger('pro_persona');
            $table->foreign('pro_persona','fk_proveedores_persona')->references('per_id')->on('personas');
            $table->unsignedBigInteger('pro_tipoProveedor');
            $table->foreign('pro_tipoProveedor','fk_proveedores_tipopersona')->references('tpp_id')->on('tipopersona');
            $table->unsignedBigInteger('pro_credito');
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
        Schema::dropIfExists('proveedores');
    }
}
