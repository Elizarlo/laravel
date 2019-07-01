<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{

    public $timestamps = false;
    protected $primaryKey = 'idventa';
    protected $table = 'venta';
    protected $fillable=[
      'idpersona','idusuario','tipo_comprobante','serie_comprobante',
      'num_comprobante','fecha_hora','impuesto','total_venta','estado'];
  
  public function usuario(){
    return $this->belongsTo('App\Usuario');
  }
  
  public function persona(){
    return $this->belongsTo('App\Persona');
  }
  
  
}
