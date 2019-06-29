<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    //
    public $timestamps = false;
    protected $primaryKey = 'iddetalle_ingreso';
    protected $table = 'detalle_ingreso';
    protected $fillable=[
       'idingreso','idarticulo','cantidad','precio_compra']; 
  
}
