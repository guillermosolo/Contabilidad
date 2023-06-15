<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanillaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilla', function (Blueprint $table) {
            $table->bigIncrements('pla_id');
            $table->date('pla_inicio');
            $table->date('pla_fin');
            $table->string('pla_descripcion',100);
            $table->string('pla_tipo',1);
            $table->boolean('pla_liquidacion');
            $table->string('pla_estado',1)->default('C');
            $table->unsignedBigInteger('pla_empresa');
            $table->foreign('pla_empresa','fk_planilla_empresa')->references('emp_id')->on('empresa');
            $table->unsignedBigInteger('pla_terminal');
            $table->foreign('pla_terminal','fk_planilla_terminal')->references('ter_id')->on('terminal');
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
        Schema::dropIfExists('planilla');
    }
}
