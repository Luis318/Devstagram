<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request){
        //dd($request);

        //Modificar el request
        $request->request->add(['username' => Str::slug($request->username)]);

        //validaciones
        $this->validate($request,[
            'name' => 'required|max:50',
            'username' => 'required|unique:users|min:3|max:30',
            'email' => 'required|unique:users|email|max:70',
            'password' => 'required|min:8|max:20|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'username' =>$request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]); 

        //autenticar usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ]);

        //Otra forma de autenticar usuario
        auth()->attempt($request->only('email','password'));

        //Redireccionar
        return redirect()->route('posts.index');
        
    }
}
