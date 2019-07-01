<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Ingreso;
use App\DetalleIngreso;

class IngresoController extends Controller
{
    //
   public function index()
    {
        //
     
 
        $ingresos = Ingreso::join('persona','ingreso.idproveedor','=','persona.idpersona')
        ->join('usuario','ingreso.idusuario','=','usuario.idpersona')
        ->select('ingreso.idingreso','ingreso.tipo_comprobante','ingreso.serie_comprobante',
        'ingreso.num_comprobante','ingreso.fecha_hora','ingreso.impuesto','ingreso.total_compra',
        'ingreso.estado','persona.nombre','usuario.usuario')
        ->orderBy('ingreso.idingreso', 'desc')->paginate(10);
       
        
        return [
            'pagination' => [
                'total'        => $ingresos->total(),
                'current_page' => $ingresos->currentPage(),
                'per_page'     => $ingresos->perPage(),
                'last_page'    => $ingresos->lastPage(),
                'from'         => $ingresos->firstItem(),
                'to'           => $ingresos->lastItem(),
            ],
            'ingresos' => $ingresos
        ];
        
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $mytime= Carbon::now('America/Monterrey');

            $ingreso = new Ingreso();
            $ingreso->idproveedor = $request->idproveedor;
            $ingreso->idusuario = "2";
            $ingreso->tipo_comprobante = $request->tipo_comprobante;
            $ingreso->serie_comprobante = $request->serie_comprobante;
            $ingreso->num_comprobante = $request->num_comprobante;
            $ingreso->fecha_hora = $mytime->toDateString();
            $ingreso->impuesto = $request->impuesto;
            $ingreso->total_compra = $request->total_compra;
            $ingreso->estado = 'Registrado';
            $ingreso->save();

            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetalleIngreso();
                $detalle->idingreso = $ingreso->idingreso;
                $detalle->idarticulo = $det['idarticulo'];
                $detalle->cantidad = $det['cantidad'];
                $detalle->precio_compra = $det['precio_compra'];          
                $detalle->save();
            }
            
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
    
  
  public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $ingreso = Ingreso::findOrFail($request->idingreso);
        $ingreso->estado = 'Anulado';
        $ingreso->save();
    }
  
  public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $ingreso = Ingreso::findOrFail($request->idingreso);
        $ingreso->estado = 'Registrado';
        $ingreso->save();
    }

}
