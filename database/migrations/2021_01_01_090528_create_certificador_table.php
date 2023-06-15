<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificador', function (Blueprint $table) {
            $table->bigIncrements('cer_id');
            $table->string('cer_nombre',100);
            $table->string('cer_direccion',200)->nullable();
            $table->string('cer_telefono',15)->nullable();
            $table->string('cer_contacto',50)->nullable();
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
        Schema::dropIfExists('certificador');
    }
}
