<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function checkLikes(User $user)
    {
        //Determinar si un usuario ha dado like a un publicacion
        //Este metedo retorna un booleano. Este metodo buscara en la tabla likes, en la columna 'user_id', un usuario que coincida con '$user->id'. si lo encuetra retorna true.
        return $this->likes->contains('user_id', $user->id);
    }
}
