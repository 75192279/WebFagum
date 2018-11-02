<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Mventas;
use App\MdetalleVentas;
use App\MdetailPayment;
use App\Musuario;
use App\Mpersona;
class VentaController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $ventas = Mventas::join('users','ventas.id_users','=','users.id')
            ->join('persona','users.id','=','persona.id')
            ->select('ventas.id','ventas.tipo_comprobante','ventas.serie',
            'ventas.numero','ventas.monto_cobrar','ventas.total',
            'ventas.estado','persona.nombre','users.usuario')
            ->orderBy('ventas.id', 'desc')->paginate(3);
        }
        else{
            $ventas = Mventas::join('users','ventas.id_users','=','users.id')
            ->join('persona','users.id','=','persona.id')
            ->select('ventas.id','ventas.tipo_comprobante','ventas.serie',
            'ventas.numero','ventas.monto_cobrar','ventas.total',
            'ventas.estado','persona.nombre','users.usuario')
            ->where('ventas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('ventas.id', 'desc')->paginate(3);
        }
        
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
    public function obtenerCabecera(Request $request){
        if (!$request->ajax()) return redirect('/');

        $id = $request->id;
        $venta = Mventas::join('users','ventas.id_users','=','users.id')
        ->join('persona','users.id','=','persona.id')
        ->select('ventas.id','ventas.tipo_comprobante','ventas.serie',
        'ventas.numero','ventas.total','ventas.total',
        'ventas.estado','persona.nombre','users.usuario')
        ->where('ventas.id','=',$id)
        ->orderBy('ventas.id', 'desc')->take(1)->get();
        
        return ['venta' => $venta];
    }
    public function obtenerDetalles(Request $request){
        if (!$request->ajax()) return redirect('/');

        $id = $request->id;
        $detalles = MdetalleVentas::join('producto','detalle_ventas.idProducto','=','producto.id')
        ->select('detalle_ventas.cantidad','detalle_ventas.precio',
        'producto.nombre as producto')
        ->where('detalle_ventas.idventa','=',$id)
        ->orderBy('detalle_ventas.id', 'desc')->get();
        
        return ['detalles' => $detalles];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $mytime= Carbon::now('America/Lima');

            $ventas=new Mventas();
            $ventas->tipoPago='Efectivo';
            $ventas->total=$request->total;
            $ventas->estado=1;
            $ventas->monto_cobrar=$request->total;
            $ventas->tipo_comprobante=$request->tipo_comprobante;
            $ventas->serie=$request->serie;
            $ventas->numero= $request->numero;
            $ventas->tipo_moneda='PEN';
            $ventas->igv='0';
            $ventas->gravada='0';
            $ventas->descuento='0';
            $ventas->tipo_entrega='0';
            $ventas->payment_time=$newdate=date("Y-m-d H:i:s");
            $ventas->id_users=$request->idcliente;;
            $ventas->save();

            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos
            $payment= new MdetailPayment();
            $payment->id_venta=$ventas->id;
            $payment->id_users=$ventas->id_users;
            $payment->tipo_pago="Efectivo";
            $payment->total=$request->total;
            $payment->abono=$request->total;
            $payment->card_number='0';
            $payment->email='0';
            $payment->client_ip='0';
            $payment->card_brand='0';
            $payment->card_type='0';
            $payment->card_category='0';
            $payment->estado="Pagado";
            $payment->save();   
              
            foreach($detalles as $ep=>$det)
            {
                $detalleVenta=new MdetalleVentas();
                $detalleVenta->idProducto=$det['idproducto'];
                $detalleVenta->idVenta=$ventas->id;
                $detalleVenta->cantidad=$det['cantidad'];
                $detalleVenta->precio=$det['precio'];
                $detalleVenta->subtotal=$det['cantidad']*$det['precio'];
                $detalleVenta->save();
            }

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $venta = Mventas::findOrFail($request->id);
        $venta->estado = 'Anulado';
        $venta->save();
    }
    

    public function crearPdfVentas(Request $request){
        $comprobante=Mventas::join('users as us','us.id','id_users')
            ->select('ventas.id','ventas.created_at','id_users','tipo_comprobante','serie','numero','tipo_moneda','total')
            ->where('ventas.id', $request->id)
            ->orderBy('ventas.id', 'DESC')
            ->get();
        $entidad=Musuario::join('persona','users.idPersona','=','persona.id')
        ->where('users.id',$comprobante[0]->id_users)->get();
        //$ubigeo=DB::table('ubigeo')->where('Codigo',$contacto->Ubigeo)->get();
        $detalleComprobante=MdetalleVentas::where('idVenta',$comprobante[0]->id)
        ->join('producto as prod','prod.id','=','idProducto')
        ->get();
        $serieNum='20760379807-'.$comprobante[0]->tipo_comprobante.'-'.$comprobante[0]->serie.'-'.$comprobante[0]->numero;
        $type=$request->type;
        
        //$data= simplexml_load_string(json_decode($xmlView));
        $signatureValue='ñmhpfoisdlhfsjns,fdbm=';
        $digestValue='shgklhlgkhdlghdlfkghkfd=';

        //return json_encode($entidad);
        \QRCode::text('20760379890|'.$comprobante[0]->tipo_comprobante.'|'.$comprobante[0]->serie.'|'.$comprobante[0]->numero.'|'.$comprobante[0]->total.'|'.date('d/m/Y').'|06|76778787|'.$digestValue.'|'.$signatureValue)->setOutfile('comprobantes/qr/'.$serieNum.'.png')->png();

        $viewVaucher=\View::make('pdf.boleta',compact('comprobante','detalleComprobante','entidad','serieNum','type','digestValue'))->render();
        
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($viewVaucher);
        $pdf->setPaper(array(0, 0, 350, 900), 'portrait');
        $pdf->setWarnings(false);
        return  $pdf->stream($serieNum.'.pdf',array("Attachment"=>0));
    }
}
