<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Culqi\Culqi;
use App\Culqi\CulqiException;
use Cart;
use App\MdetalleVentas;
use App\Mventas;
use App\Mentrega;
use App\MdetailPayment;
use DB;
class PaymentController extends Controller
{

    public function citaPayment(){
        return view('payment.index');
    }
    public function misPagos(Request $request){
        return view('cliente.pagos.index');
    }
    public function misPagosSearch(Request $request){
        /*
        $criterio = $request->criterio;
        $paginate = $request->paginate;
        if ($request->buscar&&$request->buscar==''){

            $pagos = MdetailPayment::join('cita as c','idVenta','=','v.id')
            ->join('personas as p','v.idPacivnte','=','p.id')
            ->join('tipo_consulta as t','v.tipo_consvlta','=','t.id')
            ->select('detalle_pago.id as id','t.nombre as tipo_consulta', 'idPaciente', 'idPaciente', 'fechaInicio', 'fechaFin', 'titulo', 'detalle_pago.estado as estado','p.nombre','p.apellidos','detalle_pago.total','detalle_pago.created_at as created_at')
            ->where('idPaciente', \Auth::user()->id)
            ->orderBy('detalle_pago.id', 'desc')->paginate(10);
        }
        else if($request->dateStart){
            $dateStart = $request->dateStart;
            $dateEnd = $request->dateEnd;
            $pagos = MdetailPayment::join('cita as c','idVenta','=','v.id')
            ->join('personas as p','v.idPacivnte','=','p.id')
            ->join('tipo_consulta as t','v.tipo_consvlta','=','t.id')
            ->select('detalle_pago.id as id','t.nombre as tipo_consulta', 'idPaciente', 'idPaciente', 'fechaInicio', 'fechaFin', 'titulo', 'detalle_pago.estado as estado','p.nombre','p.apellidos','detalle_pago.total','detalle_pago.created_at as created_at')
            ->where('idPaciente', \Auth::user()->id)
            ->where($criterio, '>=', $dateStart)
            ->where($criterio, '<=', $dateEnd)
            ->orderBy('detalle_pago.id', 'desc')->paginate($paginate);
        }
        else{
            $buscar = $request->buscar;
            $pagos = MdetailPayment::join('cita as c','idVenta','=','v.id')
            ->join('personas as p','v.idPacivnte','=','p.id')
            ->join('tipo_consulta as t','v.tipo_consvlta','=','t.id')
            ->select('detalle_pago.id as id','t.nombre as tipo_consulta', 'idPaciente', 'idPaciente', 'fechaInicio', 'fechaFin', 'titulo', 'detalle_pago.estado as estado','p.nombre','p.apellidos','detalle_pago.total','detalle_pago.created_at as created_at')
            ->where('idPaciente', \Auth::user()->id)
            ->where($criterio, 'like', '%'. $buscar . '%')->orderBy('detalle_pago.id', 'desc')->paginate(10);
        }
        
        
        if(!$request->pdf){
            return [
                'pagination' => [
                    'total'        => $pagos->total(),
                    'current_page' => $pagos->currentPage(),
                    'per_page'     => $pagos->perPage(),
                    'last_page'    => $pagos->lastPage(),
                    'from'         => $pagos->firstItem(),
                    'to'           => $pagos->lastItem(),
                ],
                'pagos' => $pagos
            ];
        }
        else{
            $vistaUrl="pdf.reporte_pagos";
            return $this->crearPDF($pagos,$vistaUrl,$request->pdf);
        }
        */
    }
    public function pagosSearch(Request $request){
        /*
        $criterio = $request->criterio;
        $paginate = $request->paginate;
        if ($request->buscar&&$request->buscar==''){

            $pagos = MdetailPayment::join('cita as c','idVenta','=','v.id')
            ->join('personas as p','v.idPacivnte','=','p.id')
            ->join('tipo_consulta as t','v.tipo_consvlta','=','t.id')
            ->select('detalle_pago.id as id','t.nombre as tipo_consulta', 'idEspecialista', 'idPaciente', 'fechaInicio', 'fechaFin', 'titulo', 'detalle_pago.estado as estado','p.nombre','p.apellidos','detalle_pago.total','detalle_pago.created_at as created_at')
            ->orderBy('detalle_pago.id', 'desc')->paginate(10);
        }
        else if($request->dateStart){
            $dateStart = $request->dateStart;
            $dateEnd = $request->dateEnd;
            $pagos = MdetailPayment::join('cita as c','idVenta','=','v.id')
            ->join('personas as p','v.idPacivnte','=','p.id')
            ->join('tipo_consulta as t','v.tipo_consvlta','=','t.id')
            ->select('detalle_pago.id as id','t.nombre as tipo_consulta', 'idEspecialista', 'idPaciente', 'fechaInicio', 'fechaFin', 'titulo', 'detalle_pago.estado as estado','p.nombre','p.apellidos','detalle_pago.total','detalle_pago.created_at as created_at')
            ->where($criterio, '>=', $dateStart)
            ->where($criterio, '<=', $dateEnd)
            ->orderBy('detalle_pago.id', 'desc')->paginate($paginate);
        }
        else{
            $buscar = $request->buscar;
            $pagos = MdetailPayment::join('cita as c','idVenta','=','v.id')
            ->join('personas as p','v.idPacivnte','=','p.id')
            ->join('tipo_consulta as t','v.tipo_consvlta','=','t.id')
            ->select('detalle_pago.id as id','t.nombre as tipo_consulta', 'idEspecialista', 'idPaciente', 'fechaInicio', 'fechaFin', 'titulo', 'detalle_pago.estado as estado','p.nombre','p.apellidos','detalle_pago.total','detalle_pago.created_at as created_at')
            ->where($criterio, 'like', '%'. $buscar . '%')->orderBy('detalle_pago.id', 'desc')->paginate(10);
        }
        
        
        if(!$request->pdf){
            return [
                'pagination' => [
                    'total'        => $pagos->total(),
                    'current_page' => $pagos->currentPage(),
                    'per_page'     => $pagos->perPage(),
                    'last_page'    => $pagos->lastPage(),
                    'from'         => $pagos->firstItem(),
                    'to'           => $pagos->lastItem(),
                ],
                'pagos' => $pagos
            ];
        }
        else{
            $vistaUrl="pdf.reporte_pagos";
            return $this->crearPDF($pagos,$vistaUrl,$request->pdf);
        }
        */
    }
    public function pagoListSingle(Request $request){
        /*
        $id=$request->id;
        $pago = MdetailPayment::join('cita as c','idVenta','=','v.id')
        ->join('personas as p','v.idPacivnte','=','p.id')
        ->join('tipo_consulta as t','v.tipo_consvlta','=','t.id')
        ->select('detalle_pago.id as id','t.nombre as tipo_consulta', 'idEspecialista', 'idPaciente', 'fechaInicio', 'fechaFin', 'titulo', 'detalle_pago.estado as estado','p.nombre','p.apellidos','detalle_pago.total','detalle_pago.created_at as created_at')
        ->where('detalle_pago.id', $id)
        ->get();
        $vistaUrl="pdf.reporte_pagos";
        return $this->crearPDF($pago,$vistaUrl,$request->tipo);
        */
    }
    public function crearPDF($datos,$vistaUrl,$tipo){
        /*
        $data=$datos;
        $date= date('Y-m-d');
        $view=\View::make($vistaUrl,compact('data','date'))->render();
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        if($tipo==1){return $pdf->stream('reporte');}
        if($tipo==2){return $pdf->download('reporte.pdf');}
        */
    }
    
    public function pagoUpdate(Request $request){
        /*
        $payment= MdetailPayment::find($request->id);
        $payment->abono=$request->abono;
        $payment->estado='Pagado';
        $payment->save();
        return json_encode($payment);
        */

    }
    public function Payment(Request $request)
    {
        //echo json_encode($request->data);
        $precio = $request->precio;
    	$email = $request->email;
        $token = $request->token;

    	if($token){ 
        	// Configurar tu API Key
        	$SECRET_API_KEY = "sk_test_kUZlBrOC1CjxHZtN";
    
        	// Autenticación
        	$culqi = new Culqi(array('api_key' => $SECRET_API_KEY));
        	try{
            	// Creamos Cargo a una tarjeta
            	$cargo = $culqi->Charges->create(
                	array(
                        "amount" => $precio*100,
                        "capture" => true,
                        "currency_code" => "PEN",
                        "description" => "Ahora puede realizar compras mas eficaz y eficiente.",
                        "email" => $email,
                        "installments" => 0,
                        /*
                        "antifraud_details" => array(
                            "address" => "Av. Lima 123",
                            "address_city" => "LIMA",
                            "country_code" => "PE",
                            "first_name" => "Will",
                            "last_name" => "Muro",
                            "phone_number" => "9889678986",
                        ),
                        */
                        "source_id" => $token
                    )
                );
                if($cargo->outcome->code!=='AUT0000'){
                    return json_encode(['message'=>$cargo->outcome->user_message]);
                }
                if($cargo){
                    $data=json_decode($request->data);

                    $user=\Auth::user();
                    $ventas=new Mventas();
                    $ventas->id_users=$user->id;
                    $ventas->tipoPago='Targeta';
                    $ventas->total=$precio;
                    $ventas->estado=1;
                    $ventas->monto_cobrar=$precio;
                    $ventas->tipo_comprobante='03';
                    $ventas->serie='F001';
                    $ventas->numero='0001';
                    $ventas->tipo_moneda='PEN';
                    $ventas->igv='0';
                    $ventas->gravada='0';
                    $ventas->descuento='0';
                    $ventas->tipo_entrega=$data->entrega;
                    $ventas->payment_time=$newdate=date("Y-m-d H:i:s");
                    $ventas->id_users=$user->id;
                    $ventas->save();

                    $payment= new MdetailPayment();
                    $payment->id_venta=$ventas->id;
                    $payment->id_users=$user->id;
                    $payment->tipo_pago="Targeta";
                    $payment->total=$precio;
                    $payment->abono=$precio;
                    $payment->card_number=$cargo->source->card_number;
                    $payment->email=$cargo->email;
                    $payment->client_ip=$cargo->source->client->ip;
                    $payment->card_brand=$cargo->source->iin->card_brand;
                    $payment->card_type=$cargo->source->iin->card_type;
                    $payment->card_category=$cargo->source->iin->card_category;
                    $payment->estado="Pagado";
                    $payment->save();
                    
                    if($data->entrega==1){
                        $entrega=new Mentrega();
                        $entrega->id_venta=$ventas->id;
                        $entrega->direccion=$data->direccion;
                        $entrega->numero=$data->numero;
                        $entrega->adicionainfo=$data->direccion;
                        $entrega->referencia=$data->referencia;
                        $entrega->encargado=$data->encargado;
                        $entrega->numero_contacto=$data->numero_contacto;
                        $entrega->costo='0';
                    }
                    foreach (Cart::getContent() as $value) {
                        $detalleVenta=new MdetalleVentas();
                        $detalleVenta->idProducto=$value['id'];
                        $detalleVenta->idVenta=$ventas->id;
                        $detalleVenta->cantidad=$value['quantity'];
                        $detalleVenta->precio=$value['price'];
                        $detalleVenta->subtotal=$value['quantity']*$value['price'];
                        $detalleVenta->save();
                    } 
                }
                $request->session()->put('idVenta', $ventas->id);
               Cart::clear();
                return \Response::json(['error'=>false,'message'=>'La compra se realizo con exito','data'=>$ventas]);

            
        	} catch(Exception $e){
          		$cargo2= $e->getMessage();
          		return json_encode($cargo2);
        	}
        }       
    }
    public function compraPayment(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $idVenta=$request->session()->get('idVenta');
        $cita=DB::table('ventas as v')
            ->where('v.id',$idVenta)
            ->select('v.id as id', 'id_users', 'v.estado as estado', 'payment_time')
            ->get();
        return json_encode($cita);
        //
    }
    public function compraPaymentComplete(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $idVenta=$request->session()->get('idVenta');
        $cita=DB::table('ventas as v')
            ->where('v.id',$idVenta)
            ->join('detalle_pago as d','d.id_venta','=','v.id')
            ->select('v.id as id','total','tipoPago','d.estado','d.created_at')
            ->get();
        return json_encode($cita);
        //
    }
}

