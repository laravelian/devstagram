<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'imagen'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //Almacena los seguidores de un usuario
    public function followers()
    {
        //El siguiente codigo listara todos los seguidores de la tabla 'followers' que coincidan con el 'user_id'
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    public function followings()
    {
        //El siguiente codigo listara todos los seguidores de la tabla 'followers' que coincidan con el 'follower_id'
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    //Comprobar si un usurio ya sigue a otro
    public function siguiendo(User $user)
    {
        //El siguiente codigo $this->followers mostrara todos los seguidores del perfil del usuario $user->siguiendo, posterior a ello, el metodo contains() filtrara todos los seguidores que no coincidan con el $user->id (generalmente usuario autenticado) pasado como parametro. retornara true si lo encuentra en la lista de seguidores, o false en caso contrario
        return $this->followers->contains($user->id);
    }
}
