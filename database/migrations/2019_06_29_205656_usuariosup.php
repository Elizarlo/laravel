<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Usuariosup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuario', function (Blueprint $table) {
            $table->increments('idusuario');
            $table->integer('idrol')->unsigned();
            $table->foreign('idrol')->references('idrol')->on('rol')->onDelete('cascade');
            $table->string('usuario',190);
            $table->string('password',190);
            $table->boolean('condicion')->default(1);
            $table->string('remember_token',100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
}
