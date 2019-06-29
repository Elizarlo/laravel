<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
  public $timestamps = false;
  protected $primaryKey = 'idrol';
  protected $table = 'rol';
  protected $fillable=['nombre','descripcion','estado'];
}
