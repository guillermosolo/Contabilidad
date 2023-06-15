<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccesoterminalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesoterminal', function (Blueprint $table) {
            $table->unsignedBigInteger('acct_usuario');
            $table->foreign('acct_usuario')->references('id')->on('usuario');
            $table->unsignedBigInteger('acct_terminal');
            $table->foreign('acct_terminal')->references('ter_id')->on('terminal');
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
        Schema::dropIfExists('accesoterminal');
    }
}
