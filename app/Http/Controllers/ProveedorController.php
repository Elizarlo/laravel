<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Proveedor;
use App\Persona;

class ProveedorController extends Controller
{
    //
   public function index() {
        //
      $personas = Proveedor::join('persona','proveedor.idpersona','=','persona.idpersona')
            ->select('persona.idpersona','persona.nombre','persona.tipo_documento',
            'persona.num_documento','persona.direccion','persona.telefono',
            'persona.email','proveedor.contacto','proveedor.telefono_contacto')
            ->orderBy('persona.idpersona', 'desc')->paginate(3);
       
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
        
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      if(!$request->ajax()) return redirect('/');
        //
      try{
            DB::beginTransaction();
            $persona = new Persona();
            $persona->nombre = $request->nombre;
            $persona->tipo_documento = $request->tipo_documento;
            $persona->num_documento = $request->num_documento;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->email = $request->email;
            $persona->save();

            $proveedor = new Proveedor();
            $proveedor->contacto = $request->contacto;
            $proveedor->telefono_contacto = $request->telefono_contacto;
            $proveedor->idpersona = $persona->idpersona;
            $proveedor->save();

            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
      if(!$request->ajax()) return redirect('/');
      
      try{
          DB::beginTransaction();

        
          $proveedor = Proveedor::findOrFail($request->idpersona);

          $persona = Persona::findOrFail($proveedor->idpersona);

          $persona->nombre = $request->nombre;
          $persona->tipo_documento = $request->tipo_documento;
          $persona->num_documento = $request->num_documento;
          $persona->direccion = $request->direccion;
          $persona->telefono = $request->telefono;
          $persona->email = $request->email;
          $persona->save();


          $proveedor->contacto = $request->contacto;
          $proveedor->telefono_contacto = $request->telefono_contacto;
          $proveedor->save();

          DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }
    }
  
    public function select(Request $request){
        //if (!$request->ajax()) return redirect('/');

        $filtro = $request->filtro;
        $proveedores = Proveedor::join('persona','proveedor.idpersona','=','persona.idpersona')
        ->select('persona.idpersona','persona.nombre','persona.num_documento')
        ->orderBy('persona.nombre', 'asc')->get();

        return ['proveedores' => $proveedores];
    }
}
