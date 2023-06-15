<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->bigIncrements('ven_id');
            $table->date('ven_fecha');
            $table->unsignedBigInteger('ven_persona');
            $table->foreign('ven_persona','fk_ventas_persona')->references('per_id')->on('personas');
            $table->string('ven_tipo',1)->nullable();
            $table->unsignedBigInteger('ven_moneda');
            $table->foreign('ven_moneda','fk_ventas_moneda')->references('mon_id')->on('moneda');
            $table->decimal('ven_tipoCambio',14,5)->nullable();
            $table->string('ven_descripcion',200);
            $table->decimal('ven_total',14,5);
            $table->string('ven_iiud',100)->nullable();
            $table->string('ven_numDoc',100)->nullable();
            $table->string('ven_serie',100)->nullable();
            $table->date('ven_fechaCert')->nullable();
            $table->string('ven_enlacefactura',200)->nullable();
            $table->string('ven_referencia',100)->nullable();
            $table->decimal('ven_iva',14,5)->nullable();
            $table->decimal('ven_siniva',14,5)->nullable();
            $table->boolean('ven_anulada')->default(1);
            $table->unsignedBigInteger('ven_empresa');
            $table->foreign('ven_empresa','fk_ventas_empresa')->references('emp_id')->on('empresa');
            $table->unsignedBigInteger('ven_terminal');
            $table->foreign('ven_terminal','fk_ventas_terminal')->references('ter_id')->on('terminal');
            $table->unsignedBigInteger('ven_correlativoInt');
            $table->foreign('ven_correlativoInt','fk_ventas_correlativoInt')->references('corr_id')->on('correlativoint');
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
        Schema::dropIfExists('ventas');
    }
}
