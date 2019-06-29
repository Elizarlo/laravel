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
        $roles = Rol::all();
        return $roles;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create()
    {
        //
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
      $rol = new Rol();
      $rol->nombre =       $request->nombre;
      $rol->descripcion =       $request->descripcion;
      $rol->estado = '1';
      $rol->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function show($id)
    {
        //
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function edit($id)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
      //EL metodo find or fail es para saber si recibe un objeto
      $rol = Rol::findOrFail($request->idrol);
      $rol->nombre = $request->nombre;
      $rol->descripcion = $request->descripcion;
      $rol->estado = '1';
      $rol->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function destroy($id)
    {
        //
    }*/
    public function desactivar(Request $request)
    {
      //EL metodo find or fail es para saber si recibe un objeto
      $rol = Rol::findOrFail($request->idrol);
      $rol->condicion = '0';
      $rol->save();
    }

   public function activar(Request $request)
    {//EL metodo find or fail es para saber si recibe un objeto
      $rol = Rol::findOrFail($request->idrol);
      $rol->condicion = '1';
      $rol->save();
    }
}
