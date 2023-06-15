<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->bigIncrements('per_id');
            $table->string('per_nit',13);
            $table->string('per_cui',13)->nullable();
            $table->string('per_nombre',100);
            $table->string('per_direccion',200);
            $table->string('per_telefono',15)->nullable();
            $table->string('per_contacto',100)->nullable();
            $table->string('per_email',100)->nullable();
            $table->unsignedBigInteger('per_tipoContribuyente');
            $table->foreign('per_tipoContribuyente','fk_personas_tipocontrinuyente')->references('tpc_id')->on('tipocontribuyente');
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
        Schema::dropIfExists('personas');
    }
}
