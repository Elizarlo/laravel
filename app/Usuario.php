<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //
  public $timestamps = false;
  protected $primaryKey = 'idpersona';
  protected $table = 'usuario';
  protected $fillable=['idpersona','idrol','usuario','password','condicion'];
}
