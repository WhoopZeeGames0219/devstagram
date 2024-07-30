<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function search(Request $request)
    {
        $usuario = $request->input('searchNavbar');
        $users = User::where('username', 'like', '%' . $usuario . '%')->get();

        $results = $users->map(function ($user) {
            return [
                'username' => $user->username,
                'image' => $user->imagen ? asset('storage/' . $user->imagen) : asset('img/usuario.svg'),
                'profile_url' => route('posts.index', ['user' => $user->username]),
            ];
        });

        return response()->json($results);
    }
}

