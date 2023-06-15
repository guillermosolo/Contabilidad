<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipodescTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipodesc', function (Blueprint $table) {
            $table->bigIncrements('tipd_id');
            $table->string('tipd_descripcion',50);
            $table->string('tipd_forma',1);
            $table->string('tipd_clase',1);
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
        Schema::dropIfExists('tipodesc');
    }
}
