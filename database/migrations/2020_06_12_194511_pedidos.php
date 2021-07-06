<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('pedido_id');
            $table->decimal('precio', 6, 2)->nullable(false);
            $table->string('calle')->nullable(false);
            $table->integer('altura')->nullable(false);
            $table->integer('piso')->nullable();
            $table->string('depto')->nullable();
            $table->date('fecha')->nullable(false);
            $table->integer('payment_id')->nullable(false)->unique();
            $table->unsignedInteger('ubicacion_id')->nullable(false);
            $table->unsignedInteger('usuario_id')->nullable(false);
            $table->unsignedInteger('estado_id')->nullable(false);
            $table->timestamps();

            $table->foreign('ubicacion_id')->references('ubicacion_id')->on('ubicaciones');
            $table->foreign('usuario_id')->references('usuario_id')->on('usuarios');
            $table->foreign('estado_id')->references('estado_id')->on('estadoPedido');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');

    }
}
