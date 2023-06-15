<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('prod_id');
            $table->string('prod_desc_lg',200);
            $table->string('prod_desc_ct',50)->nullable();
            $table->string('prod_codigo',11)->nullable();
            $table->unsignedBigInteger('prod_padre');
            $table->unsignedBigInteger('prod_cuentacontable');
            $table->foreign('prod_cuentacontable','fk_productos_cuentacontable')->references('cta_id')->on('cuentacontable');
            $table->unsignedBigInteger('prod_empresa');
            $table->foreign('prod_empresa','fk_productos_empresa')->references('emp_id')->on('empresa');
            $table->unsignedBigInteger('prod_terminal');
            $table->foreign('prod_terminal','fk_productos_terminal')->references('ter_id')->on('terminal');
            $table->string('prod_tipo',1)->default('S');
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
        Schema::dropIfExists('table_productos');
    }
}
