<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('producto_id');
            $table->string('nombre', 45)->nullable(false);
            $table->decimal('precio', 6, 2)->nullable(false);
            $table->text('descripcion')->nullable(false);
            $table->string('img', 45)->nullable(false);
            $table->decimal('peso', 3, 1)->nullable(true)->default(null);
            $table->string('rango_peso')->nullable(true)->default(null);
            $table->integer('promo')->nullable(true)->default(0);
            $table->unsignedInteger('unidad_id')->nullable(true)->default(null);
            $table->unsignedInteger('edad_id')->nullable(true)->default(null);
            $table->unsignedInteger('tipoAlimento_id')->nullable(true)->default(null);
            $table->unsignedInteger('marca_id')->nullable(false);
            $table->unsignedInteger('categoria_id')->nullable(false);
            $table->timestamps();

            $table->foreign('edad_id')->references('edad_id')->on('edades');
            $table->foreign('tipoAlimento_id')->references('tipoAlimento_id')->on('tipoAlimentos');
            $table->foreign('marca_id')->references('marca_id')->on('marcas');
            $table->foreign('categoria_id')->references('categoria_id')->on('categorias');
            $table->foreign('unidad_id')->references('unidad_id')->on('unidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
