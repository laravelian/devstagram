<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        //Validar los datos de inicio de sesion
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //Determinar que el usuario no se ha resgistrado previamente
        //$request->remember pasado como segundo argumento en attempt creara en la base de datos un remember_token que lo mapeara con la cookies del navegador para mantener la sesion activa
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('message', 'Credenciales invalidas');
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
