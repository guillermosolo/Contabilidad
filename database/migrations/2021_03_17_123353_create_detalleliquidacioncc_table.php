<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleliquidacionccTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleliquidacioncc', function (Blueprint $table) {
            $table->bigIncrements('dlcc_id');
            $table->unsignedBigInteger('dlcc_idcc');
            $table->foreign('dlcc_idcc','fk_detalleliquidacion_cajachica')->references('lcc_id')->on('liquidacioncc');
            $table->date('dlcc_fecha');
            $table->unsignedBigInteger('dlcc_proveedor');
            $table->foreign('dlcc_proveedor','fk_detalleLiquidacion_proveedor')->references('pro_id')->on('proveedores');
            $table->string('dlcc_tipodoc',1);
            $table->string('dlcc_seriedoc',10)->nullable();
            $table->string('dlcc_numerodoc',50);
            $table->string('dlcc_descripcion',100);
            $table->unsignedBigInteger('dlcc_terminal');
            $table->foreign('dlcc_terminal','fk_detalleliquidacion_terminal')->references('ter_id')->on('terminal');
            $table->unsignedBigInteger('dlcc_tipogasto');
            $table->foreign('dlcc_tipogasto','fk_detalleliquidacion_cuentacontable')->references('cta_id')->on('cuentacontable');
            $table->unsignedDecimal('dlcc_monto',14,5);
            $table->unsignedDecimal('dlcc_galones',4,2)->nullable();
            $table->unsignedBigInteger('dlcc_tipoCombustible')->nullable();
            $table->foreign('dlcc_tipoCombustible','fk_detalleLiquidacion_tipocombustible')->references('tco_id')->on('tipocombustible');
            $table->string('dlcc_status',1);
            $table->unsignedBigInteger('dlcc_correlativoInt');
            $table->foreign('dlcc_correlativoInt','fk_detalleLiquidacion_correlativoInterno')->references('corr_id')->on('correlativoint');
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
        Schema::dropIfExists('detalleliquidacioncc');
    }
}
