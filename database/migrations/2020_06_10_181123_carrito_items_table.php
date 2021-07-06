<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CarritoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carritoItems', function (Blueprint $table) {
            $table->increments('item_id');
            $table->unsignedInteger('producto_id')->nullable(false);
            $table->integer('cantidad')->nullable(false)->default(1);
            $table->decimal('precio', 6, 2)->nullable(false);
            $table->decimal('subtotal', 6, 2)->nullable(false);
            $table->timestamps();

            $table->foreign('producto_id')->references('producto_id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carritoItems');
    }
}
