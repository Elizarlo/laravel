<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      $roles = Rol::paginate(3);
 
        return [
            'pagination' => [
                'total'        => $roles->total(),
                'current_page' => $roles->currentPage(),
                'per_page'     => $roles->perPage(),
                'last_page'    => $roles->lastPage(),
                'from'         => $roles->firstItem(),
                'to'           => $roles->lastItem(),
            ],
            'roles' => $roles
        ];
      
      $roles = Rol::all();
      return $roles;
        
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
      $rol = new Rol();
      $rol->nombre =       $request->nombre;
      $rol->descripcion =       $request->descripcion;
      $rol->estado = '1';
      $rol->save();
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
      $rol = Rol::findOrFail($request->idrol);
      $rol->nombre = $request->nombre;
      $rol->descripcion = $request->descripcion;
      $rol->estado = '1';
      $rol->save();
    }
  
  public function desactivar(Request $request)
    {
    if(!$request->ajax()) return redirect('/');
      //EL metodo find or fail es para saber si recibe un objeto
      $rol = Rol::findOrFail($request->idrol);
      $rol->estado = '0';
      $rol->save();
    }

   public function activar(Request $request)
    {
     if(!$request->ajax()) return redirect('/');
     //EL metodo find or fail es para saber si recibe un objeto
      $rol = Rol::findOrFail($request->idrol);
      $rol->estado = '1';
      $rol->save();
    }
    
}
