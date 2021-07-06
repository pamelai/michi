<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PedidosItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidosItems', function (Blueprint $table) {
            $table->increments('item_id');
            $table->unsignedInteger('producto_id')->nullable(false);
            $table->integer('cantidad')->nullable(false)->default(1);
            $table->decimal('precio', 6, 2)->nullable(false);
            $table->unsignedInteger('pedido_id')->nullable(false);
            $table->timestamps();

            $table->foreign('producto_id')->references('producto_id')->on('productos')->onDelete('cascade');
            $table->foreign('pedido_id')->references('pedido_id')->on('pedidos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidosItems');

    }
}
