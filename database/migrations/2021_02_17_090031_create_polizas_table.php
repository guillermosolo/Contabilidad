<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolizasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polizas', function (Blueprint $table) {
            $table->bigIncrements('pol_id');
            $table->unsignedSmallInteger('pol_numero');
            $table->dateTime('pol_fecha');
            $table->string('pol_descripcion',250);
            $table->string('pol_correlativo',30)->nullable();
            $table->string('pol_proveedor',100)->nullable();
            $table->string('pol_tipo',1);
            $table->unsignedBigInteger('pol_empresa');
            $table->foreign('pol_empresa','fk_polizas_empresa')->references('emp_id')->on('empresa');
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
        Schema::dropIfExists('polizas');
    }
}
