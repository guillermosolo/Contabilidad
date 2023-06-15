<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipopersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipopersona', function (Blueprint $table) {
            $table->bigIncrements('tpp_id');
            $table->string('tpp_nombre',50);
            $table->string('tpp_nickname',5);
            $table->string('tpp_clasificacion',1);
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
        Schema::dropIfExists('tipopersona');
    }
}
