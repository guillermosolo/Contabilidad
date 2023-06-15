<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaccionbancariaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaccionbancaria', function (Blueprint $table) {
            $table->bigIncrements('trab_id');
            $table->unsignedBigInteger('trab_cuentabancaria');
            $table->foreign('trab_cuentabancaria','fk_transaccionbancaria_cuentabancaria')->references('ctab_id')->on('cuentabancaria');
            $table->date('trab_fecha');
            $table->string('trab_documento',15)->nullable();
            $table->string('trab_tipo',2);
            $table->string('trab_descripcion',200);
            $table->Decimal('trab_monto',14,5);
            $table->boolean('trab_conciliado');
            $table->unsignedBigInteger('trab_correlativoInt');
            $table->foreign('trab_correlativoInt','fk_transaccionbancaria_correlativoint')->references('corr_id')->on('correlativoint');
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
        Schema::dropIfExists('transacciobancaria');
    }
}
