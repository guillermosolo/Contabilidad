<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescuentoEventualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descuentoeventual', function (Blueprint $table) {
            $table->increments('dee_id');
            $table->unsignedBigInteger('dee_empleado');
            $table->unsignedDecimal('dee_monto',8,2);
            $table->unsignedDecimal('dee_saldo',8,2);
            $table->unsignedDecimal('dee_saldo_original',8,2);
            $table->date('dee_fecha');
            $table->string('dee_observaciones',100);
            $table->foreign('dee_empleado','fk_descuentoeventual_empleado')->references('empl_id')->on('empleados');
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
        Schema::dropIfExists('descuentoeventual');
    }
}
