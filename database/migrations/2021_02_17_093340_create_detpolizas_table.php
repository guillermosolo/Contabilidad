<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetpolizasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detpolizas', function (Blueprint $table) {
            $table->bigIncrements('dpol_id');
            $table->unsignedBigInteger('dpol_idpoliza');
            $table->unsignedBigInteger('dpol_ctaContable');
            $table->foreign('dpol_ctaContable','fk_detpolizas_ctaContable')->references('cta_id')->on('cuentacontable');
            $table->decimal('dpol_monto',14,5);
            $table->string('dpol_posicion',1);
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
        Schema::dropIfExists('detpolizas');
    }
}
