<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'comentario',
    ];

    //Cada comentario tiene un Usuario que comenta
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
