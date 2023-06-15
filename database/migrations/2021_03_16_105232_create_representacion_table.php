<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representacion', function (Blueprint $table) {
            $table->unsignedBigInteger('rep_empresa');
            $table->foreign('rep_empresa','fk_representacion_empresa')->references('emp_id')->on('empresa');
            $table->unsignedBigInteger('rep_representante');
            $table->foreign('rep_representante','fk_representacion_representante')->references('repr_id')->on('representante');
            $table->date('rep_inicio');
            $table->date('rep_fin')->nullable();
            $table->string('rep_constancia',50);
            $table->unsignedBigInteger('rep_tipo');
            $table->foreign('rep_tipo','fk_representacion_tiporepresentante')->references('trep_id')->on('tiporepresentante');
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
        Schema::dropIfExists('representacion');
    }
}
