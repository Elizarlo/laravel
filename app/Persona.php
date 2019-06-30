<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
  public $timestamps = false;
  protected $primaryKey = 'idpersona';
  protected $table = 'persona';
  protected $fillable=['nombre','tipo_documento','num_documento','direccion','telefono','email'];
  
  public function provedor(){
    return $this->hasOne('App\Proveedor');
  }
}
