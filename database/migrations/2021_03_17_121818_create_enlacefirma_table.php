<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnlacefirmaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enlacefirma', function (Blueprint $table) {
            $table->unsignedBigInteger('ef_cuentabancaria');
            $table->foreign('ef_cuentabancaria','fk_enlacefirma_cuentabancaria')->references('ctab_id')->on('cuentabancaria');
            $table->unsignedBigInteger('ef_firmante');
            $table->foreign('ef_firmante','fk_enlacefirma_firmante')->references('fir_id')->on('firmante');
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
        Schema::dropIfExists('enlacefirma');
    }
}
