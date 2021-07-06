<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CarritoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrito', function (Blueprint $table) {
            $table->increments('carrito_id');
            $table->unsignedInteger('item_id')->nullable(false);
            $table->unsignedInteger('usuario_id')->nullable(false);
            $table->timestamps();

            $table->foreign('item_id')->references('item_id')->on('carritoItems')->onDelete('cascade')->cascadeOnDelete();
            $table->foreign('usuario_id')->references('usuario_id')->on('usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carrito');
    }
}
