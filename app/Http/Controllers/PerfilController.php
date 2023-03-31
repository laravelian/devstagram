<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use PhpParser\Node\Stmt\Return_;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        return view('perfiles.edit');
    }

    public function store(Request $request)
    {
        if (!auth()->attempt($request->only('email', 'password'))) {
            return back()->with('message', 'Password incorrectos');
        }

        //Modificar el request para prevalidar el campo username para no aceptar nombres de usuarios repetidos
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil'],
            'email' => ['required', 'unique:users,email,' . auth()->user()->id],
            'new_email' => ['unique:users,email,' . auth()->user()->id],
        ]);

        $usuario = User::find(auth()->user()->id);

        if ($request->imagen) {
            $imagen = $request->file('imagen');

            //definir el nombre de la imagen, el metodo estatiico ::uuid() generara una cadena de caracteres unico
            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);

            //public_path proporciona acceso a la carpeta public
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);

            $usuario->imagen = $nombreImagen;
        }
        //Reescribir la propiedad username del modelo de usuario
        $usuario->username = $request->username;

        if ($request->new_email) {
            $usuario->email = $request->new_email;
        }

        $usuario->password = Hash::make($request->new_password);

        $usuario->save();
        //Redireccionar
        return redirect()->route('posts.index', $usuario->username);
    }
}
