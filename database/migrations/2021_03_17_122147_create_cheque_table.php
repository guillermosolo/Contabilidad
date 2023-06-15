<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChequeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cheque', function (Blueprint $table) {
            $table->bigIncrements('che_id');
            $table->unsignedBigInteger('che_cuentabancaria');
            $table->foreign('che_cuentabancaria','fk_cheque_cuentabancaria')->references('ctab_id')->on('cuentabancaria');
            $table->string('che_numero',15);
            $table->date('che_fecha');
            $table->decimal('che_monto',14,5);
            $table->string('che_beneficiario',100);
            $table->string('che_descripcion',200);
            $table->boolean('che_negociable');
            $table->string('che_tipo',2);
            $table->decimal('che_tc',14,5);
            $table->unsignedBigInteger('che_correlativoInt');
            $table->foreign('che_correlativoInt','fk_cheque_correlativoint')->references('corr_id')->on('correlativoint');
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
        Schema::dropIfExists('cheque');
    }
}
