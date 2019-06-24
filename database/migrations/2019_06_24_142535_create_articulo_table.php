<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticuloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulo', function (Blueprint $table) {
            $table->increments('idarticulo');
            $table->foreign('idcategoria')->references('idcategoria')->on('categoria')->onDelete('cascade');
            $table->string('codigo',50);
            $table->string('nombre',100);
            $table->decimal('precio_venta', 11, 2);
            $table->integer('stock');
            $table->string('descripcion',255);
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
        Schema::dropIfExists('articulo');
    }
}
