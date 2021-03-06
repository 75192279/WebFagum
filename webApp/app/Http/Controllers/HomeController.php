<?php

namespace App\Http\Controllers;
use App\Mventas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
        return view('home.index');
    }
    public function producto(Request $request){
        return view('home.producto');
    }
    public function carrito(Request $request){
        return view('home.carrito');
    }
    public function contacto(Request $request){
        return view('home.contacto');
    }
    public function MisCompras(Request $request){
        return view('home.mis-compras');
    }
    public function MisComprasList(Request $request){
        if (!$request->ajax()) return redirect('/');

        $user = \Auth::user();
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $ventas = Mventas::join('users','ventas.id_users','=','users.id')
            ->join('persona','users.id','=','persona.id')
            ->select('ventas.id','ventas.tipo_comprobante','ventas.serie',
            'ventas.numero','ventas.monto_cobrar','ventas.total',
            'ventas.estado','persona.nombre','users.usuario')
            ->where('ventas.id_users',$user->id)
            ->orderBy('ventas.id', 'desc')->paginate(3);
        }
        else{
            $ventas = Mventas::join('users','ventas.id_users','=','users.id')
            ->join('persona','users.id','=','persona.id')
            ->select('ventas.id','ventas.tipo_comprobante','ventas.serie',
            'ventas.numero','ventas.monto_cobrar','ventas.total',
            'ventas.estado','persona.nombre','users.usuario')
            ->where('ventas.id_users',$user->id)
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
