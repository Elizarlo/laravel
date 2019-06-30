<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    //
  public $timestamps = false;
  
  protected $table = 'proveedor';
  protected $fillable=['idpersona','contacto','telefono_contacto'];
  protected $primaryKey = 'idpersona';
  public function persona(){
    return $this->belongsTo('App\Persona');
  }
}
