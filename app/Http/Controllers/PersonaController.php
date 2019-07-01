<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      $personas = Persona::paginate(3);
 
        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
            ],
            'personas' => $personas
        ];
      
      $personas = Persona::all();
      return $personas;
        
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
      $persona = new Persona();
      $persona->nombre =       $request->nombre;
      $persona->tipo_documento =       $request->tipo_documento;
      $persona->num_documento =       $request->num_documento;
      $persona->direccion =       $request->direccion;
      $persona->telefono =       $request->telefono;
      $persona->email =       $request->email;
      $persona->save();
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
      $persona = Persona::findOrFail($request->idpersona);
      $persona->nombre =       $request->nombre;
      $persona->tipo_documento =       $request->tipo_documento;
      $persona->num_documento =       $request->num_documento;
      $persona->direccion =       $request->direccion;
      $persona->telefono =       $request->telefono;
      $persona->email =       $request->email;      
      $persona->save();
    }
    
  public function select()
    {
     
     //EL metodo find or fail es para saber si recibe un objeto
      $personas = Persona::all();
      return $personas;
    }
}