<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      $usuarios = Usuario::join('persona','usuario.idpersona','=','persona.idpersona')
            ->select('persona.nombre','usuario.idpersona','usuario.idrol','usuario.usuario','usuario.password','usuario.condicion')
            ->orderBy('persona.nombre', 'desc')->paginate(3);
        return [
            'pagination' => [
                'total'        => $usuarios->total(),
                'current_page' => $usuarios->currentPage(),
                'per_page'     => $usuarios->perPage(),
                'last_page'    => $usuarios->lastPage(),
                'from'         => $usuarios->firstItem(),
                'to'           => $usuarios->lastItem(),
            ],
            'usuarios' => $usuarios
        ];
      
     // $usuarios = Usuario::all();
      return $usuarios;
        
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
      $usuario = new Usuario();
      $usuario->idpersona =       $request->idpersona;
      $usuario->idrol =       $request->idrol;
      $usuario->usuario =       $request->usuario;
      $usuario->password =       $request->password;
      $usuario->condicion = '1';
      $usuario->save();
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
      $usuario = Usuario::findOrFail($request->idpersona);
      $usuario->idpersona =       $request->idpersona;
      $usuario->idrol =       $request->idrol;
      $usuario->usuario =       $request->usuario;
      $usuario->password =       $request->password;
      $usuario->condicion = '1';
      $usuario->save();
    }
  
  public function desactivar(Request $request)
    {
    if(!$request->ajax()) return redirect('/');
      //EL metodo find or fail es para saber si recibe un objeto
      $usuario = Usuario::findOrFail($request->idpersona);
      $usuario->condicion = '0';
      $usuario->save();
    }

   public function activar(Request $request)
    {
     if(!$request->ajax()) return redirect('/');
     //EL metodo find or fail es para saber si recibe un objeto
      $usuario = Usuario::findOrFail($request->idpersona);
      $usuario->condicion = '1';
      $usuario->save();
    }
    
}
