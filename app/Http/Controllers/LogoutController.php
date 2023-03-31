<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function store()
    {
        //Cerrar sesion del usuario actual
        auth()->logout();

        return redirect()->route('login');
    }
}
