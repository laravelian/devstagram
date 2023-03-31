@extends('layouts.app')

@section('titulo')
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form class="mt-10 md:mt-0" action="{{ route('perfil.store', auth()->user()) }}" method="post"
                enctype="multipart/form-data">
                @csrf

                @if (session('message'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('message') }}</p>
                @endif

                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold mt-4">
                    Username
                </label>

                <input type="text" id="username" name="username" placeholder="Tu Nombre de Usuario"
                    class="border p-3 w-full rounded-lg @error('username')
                        border-red-500
                    @enderror"
                    value="{{ auth()->user()->username }}">

                @error('username')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror

                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold mt-4">
                    Email:
                </label>

                <input type="email" id="email" name="email" placeholder="Ingrese su email de Registro"
                    class="border p-3 w-full rounded-lg @error('email')
                        border-red-500
                    @enderror"
                    value="">

                @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror

                <label for="new_email" class="mb-2 block uppercase text-gray-500 font-bold mt-4">
                    Nuevo correo (Opcional)
                </label>

                <input type="email" id="new_email" name="new_email" placeholder="Ingrese su nuevo Email"
                    class="border p-3 w-full rounded-lg @error('new_email')
                        border-red-500
                    @enderror"
                    value="">

                @error('new_email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror

                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold mt-4">
                    Password
                </label>

                <input type="password" id="password" name="password" placeholder="Password de Registro"
                    class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror

                <label for="new_password" class="mb-2 mt-4 block uppercase text-gray-500 font-bold">
                    Nueva Contraseña (Opcional)
                </label>

                <input type="password" id="new_password" name="new_password" placeholder="Nueva contraseña"
                    class="border p-3 w-full rounded-lg @error('new_password') border-red-500 @enderror">
                @error('new_password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror

                <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold mt-4">
                    Imagen Perfil
                </label>

                <input type="file" id="imagen" name="imagen" class="border p-3 w-full rounded-lg mb-4" value=""
                    accept=".jpg, .jpeg, .png">

                <input type="submit" value="Guardar Cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

            </form>
        </div>
    </div>
@endsection
