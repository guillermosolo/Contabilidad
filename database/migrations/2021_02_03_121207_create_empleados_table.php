<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->unsignedBigInteger('empl_id');
            $table->string('empl_codigo',10)->nullable();
            $table->string('empl_nom1',15);
            $table->string('empl_nom2',15)->nullable();
            $table->string('empl_ape1',15);
            $table->string('empl_ape2',15)->nullable();
            $table->unsignedInteger('empl_sexo');
            $table->unsignedInteger('empl_nacionalidad');
            $table->foreign('empl_nacionalidad','fk_empleados_paises')->references('pai_id')->on('paises');
            $table->unsignedInteger('empl_discapacidad');
            $table->foreign('empl_discapacidad','fk_empleados_discapacidad')->references('dis_id')->on('discapacidad');
            $table->unsignedInteger('empl_estadoCivil');
            $table->unsignedInteger('empl_tipoDocID');
            $table->string('empl_docID',25);
            $table->unsignedInteger('empl_origen');
            $table->foreign('empl_origen','fk_empleados_paises2')->references('pai_id')->on('paises');
            $table->string('empl_lugNac',8);
            $table->foreign('empl_lugNac','fk_empleados_depmun')->references('dep_id')->on('depmun');
            $table->string('empl_NIT',9)->nullable();
            $table->string('empl_IGSS',25)->nullable();
            $table->date('empl_fecNac');
            $table->unsignedInteger('empl_hijos');
            $table->unsignedInteger('empl_nivelAcad');
            $table->foreign('empl_nivelAcad','fk_empleados_academico')->references('aca_id')->on('academico');
            $table->string('empl_titulo',100)->nullable();
            $table->unsignedInteger('empl_pueblo');
            $table->foreign('empl_pueblo','fk_empleados_pueblo')->references('pue_id')->on('pueblo');
            $table->unsignedInteger('empl_temporalidad');
            $table->unsignedInteger('empl_tipoContrato');
            $table->date('empl_inicio');
            $table->date('empl_retiro')->nullable();
            $table->string('empl_ocupacion',4);
            $table->unsignedInteger('empl_jornada');
            $table->string('empl_expedienteExt',50)->nullable();
            $table->string('empl_tipoSalario',1);
            $table->unsignedDecimal('empl_salario',8,2);
            $table->unsignedBigInteger('empl_empresa');
            $table->foreign('empl_empresa','fk_empleados_empresa')->references('emp_id')->on('empresa');
            $table->unsignedBigInteger('empl_terminal');
            $table->foreign('empl_terminal','fk_empleados_terminal')->references('ter_id')->on('terminal');
            $table->timestamps();
            $table->primary('empl_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
