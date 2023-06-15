<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReporteHoraETable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportehorae', function (Blueprint $table) {
            $table->increments('ree_id');
            $table->unsignedBigInteger('ree_empleado');
            $table->date('ree_fecha');
            $table->integer('ree_horas');
            //Tipo E horas extras //Tipo O Horas Ordinarias
            $table->string('ree_tipo',1);
            $table->foreign('ree_empleado','fk_reportehorae_empleado')->references('empl_id')->on('empleados');
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
        Schema::dropIfExists('reportehorae');
    }
}
