<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    //
  public $timestamps = false;
    protected $primaryKey = 'iddetalle_venta';
    protected $table = 'detalle_venta';
    protected $fillable=[
       'idventa','idarticulo','cantidad','precio_venta','descuento']; 
}
