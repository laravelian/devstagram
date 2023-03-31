<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //Modificar el request para prevalidar el campo username para no aceptar nombres de usuarios repetidos
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'name' => ['required', 'max:30'],
            'username' => ['required', 'unique:users', 'min:3', 'max:20'],
            'email' => ['required', 'unique:users', 'email', 'max:30'],
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //Autenticar usuario
        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
