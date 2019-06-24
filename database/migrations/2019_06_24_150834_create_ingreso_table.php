<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingreso', function (Blueprint $table) {
            $table->increments('idingreso');
            $table->integer('idproveedor')->unsigned();
            $table->foreign('idproveedor')->references('idproveedor')->on('proveedor')->onDelete('cascade');
            $table->integer('idusuario')->unsigned();
            $table->foreign('idusuario')->references('idusuario')->on('usuario')->onDelete('cascade');
            $table->string('tipo_comprobante',20);
            $table->string('serie_comprobante',7);
            $table->string('num_comprobante',10);
            $table->dateTime('fecha_hora');
            $table->decimal('impuesto', 4, 2);
            $table->decimal('total_compra', 11, 2);
            $table->string('estado',20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingreso');
    }
}
