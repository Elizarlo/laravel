<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Venta;
use App\DetalleVenta;

class VentaController extends Controller
{
    //
   public function index()
    {
        //idventa	idpersona	idusuario	tipo_comprobante	serie_comprobante	num_comprobante	fecha_hora	impuesto	total_venta	estado
 
        $ventas = Venta::join('persona','venta.idpersona','=','persona.idpersona')
        ->join('usuario','venta.idusuario','=','usuario.idpersona')
        ->select('venta.idventa','venta.tipo_comprobante','venta.serie_comprobante',
        'venta.num_comprobante','venta.fecha_hora','venta.impuesto','venta.total_venta',
        'venta.estado','persona.nombre','usuario.usuario')
        ->orderBy('venta.idventa', 'desc')->paginate(10);
       
       
        return [
            'pagination' => [
                'total'        => $ventas->total(),
                'current_page' => $ventas->currentPage(),
                'per_page'     => $ventas->perPage(),
                'last_page'    => $ventas->lastPage(),
                'from'         => $ventas->firstItem(),
                'to'           => $ventas->lastItem(),
            ],
            'ventas' => $ventas
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

            $venta = new Venta();
            $venta->idpersona = $request->idpersona;
            $venta->idusuario = "2";
            $venta->tipo_comprobante = $request->tipo_comprobante;
            $venta->serie_comprobante = $request->serie_comprobante;
            $venta->num_comprobante = $request->num_comprobante;
            $venta->fecha_hora = $mytime->toDateString();
            $venta->impuesto = $request->impuesto;
            $venta->total_venta = $request->total_venta;
            $venta->estado = 'Registrado';
            $venta->save();

            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {//iddetalle_venta	idventa	idarticulo	cantidad	precio_venta	descuento
                $detalle = new DetalleVenta();
                $detalle->idventa = $venta->idventa;
                $detalle->idarticulo = $det['idarticulo'];
                $detalle->cantidad = $det['cantidad'];
                $detalle->precio_venta = $det['precio_venta'];   
                $detalle->descuento = $det['descuento'];   
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
        $venta = Ingreso::findOrFail($request->idventa);
        $venta->estado = 'Anulado';
        $venta->save();
    }
  
  public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $venta = Ingreso::findOrFail($request->idventa);
        $venta->estado = 'Registrado';
        $venta->save();
    }

}
