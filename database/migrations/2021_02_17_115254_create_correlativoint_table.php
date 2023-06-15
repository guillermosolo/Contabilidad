<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorrelativointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correlativoint', function (Blueprint $table) {
            $table->bigIncrements('corr_id');
            $table->unsignedBigInteger('corr_empresa');
            $table->unsignedBigInteger('corr_terminal');
            $table->string('corr_tipo',1);
            $table->unsignedTinyInteger('corr_mes');
            $table->unsignedTinyInteger('corr_anio');
            $table->unsignedSmallInteger('corr_especifico');
            $table->unsignedInteger('corr_general');
            $table->string('corr_correlativo',30);
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
        Schema::dropIfExists('correlativoint');
    }
}
