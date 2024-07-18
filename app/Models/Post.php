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

    //Relacion Belongs To
    //Un Post pertenece a un Usuario
    public function user()
    {
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    //Un post va a tener multiples comentarios
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    //Un post va a tener muchos likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //Revisar si ese Post ya tiene un like del Usuario auth
    public function checkLike(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }
}
