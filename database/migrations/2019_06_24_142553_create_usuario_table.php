<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->increments('idusuario');
            $table->foreign('idpersona')->references('idpersona')->on('persona')->onDelete('cascade');
            $table->foreign('idrol')->references('idrol')->on('rol')->onDelete('cascade');
            $table->string('clave',64);
            $table->boolean('condicion')->default(1);
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
