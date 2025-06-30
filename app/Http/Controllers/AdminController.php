<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index(){
        return view('admin.dashboard');
    }


    public function login(){
         return view('auth.login');
    }

    public function dologin(Request $request){
        $validate=$request->validate([
            "email"=>"required",
            "password"=>"required"
        ],[
            "email.required"=>"L'email est requis",
            "password.required"=>"Le mot de passe  est requis"
        ]);

        if(!Auth::attempt($validate)){
            return redirect()->back()->with('error','Email ou mot de passe incorrect');
        }  
        return redirect()->intended(route('admin.dashboard'))->with('success',"Connexion effectué avec succes");    
    }

  public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('status', 'Déconnexion réussie.');
    }
}
