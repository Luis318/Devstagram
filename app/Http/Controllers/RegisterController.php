<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request){
        //dd($request);

        //validaciones
        $this->validate($request,[
            'name' => 'required|max:50',
            'username' => 'required|unique:users|min:3|max:30',
            'email' => 'required|unique:users|email|max:70',
            'password' => 'required|min:8|max:20|confirmed',
        ]);

        dd('creando usuario');
    }
}
