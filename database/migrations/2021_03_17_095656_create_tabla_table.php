<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabla', function (Blueprint $table) {
            $table->bigIncrements('tab_id');
            $table->unsignedBigInteger('tab_activo');
            $table->unsignedTinyInteger('tab_mes');
            $table->unsignedSmallInteger('tab_anio');
            $table->unsignedDecimal('tab_monto',14,5);
            $table->string('tab_tipo',1);
            $table->boolean('tab_operado')->default(0);
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
        Schema::dropIfExists('tabla');
    }
}
