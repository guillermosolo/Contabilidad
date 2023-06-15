<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentrocostoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centrocosto', function (Blueprint $table) {
            $table->unsignedBigInteger('cco_id');
            $table->string('cco_codigo',3);
            $table->string('cco_descripcion',125);
            $table->unsignedBigInteger('cco_regimen');
            $table->foreign('cco_regimen','fk_centrocosto_regimen')->references('reg_id')->on('regimen');
            $table->timestamps();
            $table->primary('cco_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('centrocosto');
    }
}
