<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Musuario;
use Redirect;
use App\Mpersona;
class LoginController extends Controller
{

    protected function validateLogin(Request $request){
        $this->validate($request,[
            'correo' => 'required|string',
            'password' => 'required|string'
        ]);

    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
    public function login(Request $request){
        $this->validateLogin($request);        
        if (Auth::attempt(['correo' => $request->correo,'password' => $request->password,'estado'=>1])){
           return Auth::user();
        }

        return back()
        ->withErrors(['correo' => trans('Credenciales incorrectos')])
        ->withInput(request(['correo']));
    }
}
