<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnlacedescbonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enlacedescbon', function (Blueprint $table) {
            $table->unsignedBigInteger('edb_empleado');
            $table->foreign('edb_empleado','fk_enlaceDescBon_empleado')->references('empl_id')->on('empleados');
            $table->unsignedBigInteger('edb_descbon');
            $table->foreign('edb_descbon','fk_enlaceDescBon_desBon')->references('desc_id')->on('descbon');
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
        Schema::dropIfExists('enlacedescbon');
    }
}
