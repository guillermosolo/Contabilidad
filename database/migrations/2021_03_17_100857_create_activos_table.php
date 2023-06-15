<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activos', function (Blueprint $table) {
            $table->bigIncrements('act_id');
            $table->string('act_descripcion',100);
            $table->unsignedBigInteger('act_categoria');
            $table->foreign('act_categoria','fk_activos_categoria')->references('cat_id')->on('categoria');
            $table->string('act_correlativo')->nullable();
            $table->string('act_serie',50)->nullable();
            $table->date('act_fechaAlta');
            $table->unsignedDecimal('act_valor',14,5);
            $table->unsignedBigInteger('act_status');
            $table->foreign('act_status','fk_activos_statusActivos')->references('sta_id')->on('statusactivos');
            $table->unsignedBigInteger('act_cuentaDep');
            $table->foreign('act_cuentaDep','fk_activos_cuentaContable')->references('cta_id')->on('cuentacontable');
            $table->unsignedBigInteger('act_cuentaDepAcum');
            $table->foreign('act_cuentaDepAcum','fk_activos_cuentaContable2')->references('cta_id')->on('cuentacontable');
            $table->date('act_fechaBaja')->nullable();
            $table->boolean('act_propio');
            $table->unsignedDecimal('act_inicial',14,5)->nullable();
            $table->unsignedDecimal('act_porcentaje',7,5)->nullable();
            $table->unsignedBigInteger('act_empresa');
            $table->foreign('act_empresa','fk_activos_empresa')->references('emp_id')->on('empresa');
            $table->unsignedBigInteger('act_terminal');
            $table->foreign('act_terminal','fk_activos_terminal')->references('ter_id')->on('terminal');
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
        Schema::dropIfExists('activos');
    }
}
