<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articulo;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $articulos = Articulo::join('categoria','articulo.idcategoria','=','categoria.idcategoria')
            ->select('categoria.nombre as nombrec','articulo.idarticulo','articulo.codigo','articulo.nombre','articulo.precio_venta','articulo.stock','articulo.descripcion','articulo.condicion')
            ->orderBy('articulo.nombre', 'desc')->paginate(3);
        return [
            'pagination' => [
                'total'        => $articulos->total(),
                'current_page' => $articulos->currentPage(),
                'per_page'     => $articulos->perPage(),
                'last_page'    => $articulos->lastPage(),
                'from'         => $articulos->firstItem(),
                'to'           => $articulos->lastItem(),
            ],
            'articulos' => $articulos
        ];
      
      return $articulos;
        
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if(!$request->ajax()) return redirect('/');
        //
      $articulo = new Articulo();
      $articulo->idcategoria =       $request->idcategoria;
      $articulo->codigo =       $request->codigo;
      $articulo->nombre =       $request->nombre;
      $articulo->precio_venta =       $request->precio_venta;
      $articulo->stock =       $request->stock;
      $articulo->descripcion =       $request->descripcion;
      $articulo->condicion = '1';
      $articulo->save();
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      if(!$request->ajax()) return redirect('/');
      
        //EL metodo find or fail es para saber si recibe un objeto
      $articulo = Articulo::findOrFail($request->idarticulo);
      $articulo->idcategoria =       $request->idcategoria;
      $articulo->codigo =       $request->codigo;
      $articulo->nombre =       $request->nombre;
      $articulo->precio_venta =       $request->precio_venta;
      $articulo->stock =       $request->stock;
      $articulo->descripcion =       $request->descripcion;
      $articulo->condicion = '1';
      $articulo->save();
    }
  
  public function desactivar(Request $request)
    {
    if(!$request->ajax()) return redirect('/');
      //EL metodo find or fail es para saber si recibe un objeto
      $articulo = Articulo::findOrFail($request->idarticulo);
      $articulo->condicion = '0';
      $articulo->save();
    }

   public function activar(Request $request)
    {
     if(!$request->ajax()) return redirect('/');
     //EL metodo find or fail es para saber si recibe un objeto
      $articulo = Articulo::findOrFail($request->idarticulo);
      $articulo->condicion = '1';
      $articulo->save();
    }
  
  public function select()
    {
     
     //EL metodo find or fail es para saber si recibe un objeto
      $articulos = Articulo::all();
      return $articulos;
    }
    
}