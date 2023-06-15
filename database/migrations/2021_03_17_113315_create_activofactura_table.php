<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivofacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activofactura', function (Blueprint $table) {
            $table->unsignedBigInteger('af_activo');
            $table->foreign('af_activo','fk_activofactura_activos')->references('act_id')->on('activos');
            $table->unsignedBigInteger('af_documento');
            $table->string('af_tipoDoc',1);
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
        Schema::dropIfExists('activofactura');
    }
}
