<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke()
    {
        //Obtener a quienes seguimos
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $users = User::where('id', '!=', Auth::id())->inRandomOrder()->get();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);

        return view('home', ['posts' => $posts, 'users' => $users]);
    }
}
