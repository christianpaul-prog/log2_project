<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //
       function login(){
    return view('auth.login');
   }
   function register(){
    return view('auth.register');
   }
   function loginPost(Request $request){
    $request ->validate([
        'email'=> 'required',
        'password'=> 'required'

    ]);
     $credentials = $request->only('email','password');
     if (Auth::attempt($credentials)){
        return redirect()->intended(route('pages.dashboard'));
     }
     return redirect(route('auth.login'))->with("error","Login are not valid");
   }
   function registerpost(Request $request){
     $request ->validate([
        'name'=>'required',
        'email'=> 'required|email|unique:users',
        'password'=> 'required'

    ]);
    $data['name']= $request->name;
    $data['email'] = $request->email;
    $data['password'] = Hash::make($request->password); 
    $user = User::create($data);
    if(!$user){
           return redirect(route('auth.register'))->with("error","register are not valid");

    }
         return redirect(route('auth.login'))->with("success","success  register, go to log in");

   }
   function logout(){
    Session::flush();
    Auth::logout();
    return redirect(route('auth.login'));
   }
}
