<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    // Textos completos 	idarticulo 	idcategoria 	codigo 	nombre 	precio_venta 	stock 	descripcion 	condicion
  public $timestamps = false;
  protected $primaryKey = 'idarticulo';
  protected $table = 'articulo';
  protected $fillable=['idcategoria','codigo','nombre','precio_venta','stock','descripcion','condicion'];
}
