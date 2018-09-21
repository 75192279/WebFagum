<?php

namespace App\Http\Controllers;

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
}
