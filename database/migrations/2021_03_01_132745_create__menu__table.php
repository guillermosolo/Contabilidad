<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('menu', function (Blueprint $table) {
                $table->unsignedBigInteger('men_id');
                $table->unsignedBigInteger('men_padre')->default(0);
                $table->string('men_nombre',50);
                $table->string('men_url',100);
                $table->unsignedInteger('men_orden')->default(0);
                $table->string('men_icono',50)->nullable();
                $table->boolean('men_deshabilitado')->default(0);
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
        Schema::dropIfExists('_menu_');
    }
}
