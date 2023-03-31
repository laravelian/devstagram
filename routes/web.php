<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->name('home');

Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

//'/{user:username}' es una ruta asociada a un modelo. en este caso el modelo es User, el metodo del controlador enrutado debe ser capaz de recibir como parametro el modelo asociado store|index|create|edit|delete(User $user)
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');

Route::post('posts/{post}/likes', [LikeController::class, 'store'])->name('like.store');
Route::delete('posts/{post}/likes', [LikeController::class, 'destroy'])->name('like.destroy');

Route::get('/{user:username}/edit', [PerfilController::class, 'edit'])->name('perfil.edit');
Route::post('/{user:username}/edit', [PerfilController::class, 'store'])->name('perfil.store');

Route::post('/{user:name}/follow', [FollowerController::class, 'store'])->name('follow.store');
Route::delete('/{user:name}/unfollow', [FollowerController::class, 'destroy'])->name('follow.destroy');
