<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegularizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regularizaciones', function (Blueprint $table) {
            $table->unsignedBigInteger('regu_cuentaD');
            $table->foreign('regu_cuentaD','fk_cuentaD_cuentacontable')->references('cta_id')->on('cuentacontable');
            $table->unsignedBigInteger('regu_cuentaH');
            $table->foreign('regu_cuentaH','fk_cuentaH_cuentacontable')->references('cta_id')->on('cuentacontable');
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
        Schema::dropIfExists('regularizaciones');
    }
}
