<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function loginCheck(Request $r){
        if(Auth::attempt(['email' => $r->email, 'password' => $r->password])){
            $r->session()->regenerate();
            session()->put('user', Auth::user());
            return redirect('/');
        }
        return redirect('/login')->with("error", "Username Atau Password Salah!");
    }

    public function logout(){
        Auth()->logout();
        session()->invalidate();
        session()->regenerate();
    }
}
