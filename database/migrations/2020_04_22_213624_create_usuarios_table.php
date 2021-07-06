<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('usuario_id');
            $table->string('nombre', 45)->nullable()->default(null);
            $table->string('apellido', 45)->nullable()->default(null);
            $table->string('email', 150)->nullable(false)->unique();
            $table->string('user_name', 100)->nullable(false)->unique();
            $table->string('password', 255)->nullable(false);
            $table->string('img', 255)->nullable()->default(null);
            $table->rememberToken();
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
        Schema::dropIfExists('usuarios');
    }
}
