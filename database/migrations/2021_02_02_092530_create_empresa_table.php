<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->unsignedBigInteger('emp_id');
            $table->string('emp_nombre',100);
            $table->string('emp_siglas',15)->nullable();
            $table->string('emp_NIT',13);
            $table->string('emp_municipio',8);
            $table->foreign('emp_municipio','fk_empresa_municipio')->references('dep_id')->on('depmun');
            $table->string('emp_actividad',9);
            $table->string('emp_descripcion',200);
            $table->unsignedBigInteger('emp_regimen');
            $table->foreign('emp_regimen','fk_empresa_regimen')->references('reg_id')->on('regimen');
            $table->unsignedBigInteger('emp_fel');
            $table->foreign('emp_fel','fk_empresa_fel')->references('cer_id')->on('certificador');
            $table->date('emp_inicio');
            $table->boolean('emp_activa');
            $table->string('emp_CUI',13)->nullable();
            $table->unsignedInteger('emp_nacionalidad');
            $table->foreign('emp_nacionalidad','fk_empresa_paises')->references('pai_id')->on('paises');
            $table->string('emp_numeroIGSS',15)->nullable();
            $table->string('emp_colonia',50)->nullable();
            $table->unsignedBigInteger('emp_zona')->nullable();
            $table->string('emp_calle',25)->nullable();
            $table->string('emp_avenida',25)->nullable();
            $table->string('emp_nomenclatura',25)->nullable();
            $table->string('emp_sitioWeb',50)->nullable();
            $table->string('emp_email',50)->nullable();
            $table->boolean('emp_sindicato')->default(0);
            $table->string('emp_telefono',15)->nullable();
            $table->string('emp_nomComercial',50);
            $table->string('emp_direccion',100)->nullable();
            $table->timestamps();
            $table->primary('emp_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa');
    }
}
