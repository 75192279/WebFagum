<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Cart;
use App\MdetalleVentas;
use App\Mventas;
class CarritoController extends Controller
{
    /*
    public function __construct(){
        $userId=
        \Cart::session($userId)->add();
    }
    */
    public function AddCart(Request $request){
        /*

        if(Cart::get($request->producto['id'])){
            Cart::update($request->producto['id'], array(
                'quantity' => +1,
            ));
            return Cart::getContent();
        }
        */
        Cart::add(array(
            'id' =>  $request->producto['id'],
            'name' => $request->producto['nombre'],
            'price' => $request->producto['precio'],
            'quantity' => 1,
            'attributes' => array()
        ));

        return  json_encode(Cart::getContent());
    }
    public function listarCarts(){

        return  json_encode(Cart::getContent()); 
    }
    public function actionCart(Request $request){
        if($request->accion=='rest'){
            if(Cart::get($request->producto['id'])){
                Cart::update($request->producto['id'], array(
                    'quantity' => -1,
                ));
                return json_encode(Cart::getContent());
            }
        }
        if($request->accion=='sum'){
            if(Cart::get($request->producto['id'])){
                Cart::update($request->producto['id'], array(
                    'quantity' => +1,
                ));
                return json_encode(Cart::getContent());
            }
        }
    }
    public function checkedUser(Request $request){
        if(isset(\Auth::user()->id)){
            return \Response::json(['error'=>false,'message'=>'el usuario autenticado','data'=>\Auth::user()]);
        }
        else{
            return \Response::json(['error'=>true,'message'=>'el usuario no esta autenticado','data'=>null]);
        }
    }
    public function realizarCompra(Request $request){
        $ventas=new Mventas();
        $ventas->id_users=\Auth::user()->id;
        $ventas->tipoPago='Efectivo';
        $ventas->save();
        foreach (Cart::getContent() as $value) {
            $detalleVenta=new MdetalleVentas();
            $detalleVenta->idProducto=$value['id'];
            $detalleVenta->idVenta=$ventas->id;
            $detalleVenta->cantidad=$value['quantity'];
            $detalleVenta->precio=$value['price'];
            $detalleVenta->subtotal=$value['quantity']*$value['price'];
            $detalleVenta->save();
        }
        Cart::clear();
        
        return \Response::json(['error'=>false,'message'=>'La compra se realizo con exito','data'=>$ventas]);


    }

}
