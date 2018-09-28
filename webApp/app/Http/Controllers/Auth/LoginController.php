<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Musuario;
use Redirect;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Mpersona;
class LoginController extends Controller
{
    //protected $redirectTo = '/admin';

    public function __construct($auth=null){
        $this->auth=\Auth::guard($auth);
        $this->middleware('guest',['except'=>'logout']);
    }
    protected function validateLogin(Request $request){
        $this->validate($request,[
            'correo' => 'required|string',
            'password' => 'required|string'
        ]);

    }
    public function viewLogin(Request $request){
        return view('login.login');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
    public function login(Request $request){   
        if (Auth::attempt(['correo' => $request->correo,'password' => $request->password,'estado'=>1])){
           return Auth::user();
        }
        
        return response()->json(['error' => 'correo electrónico o contraseña no coincide
        '], 401);
    }
}
