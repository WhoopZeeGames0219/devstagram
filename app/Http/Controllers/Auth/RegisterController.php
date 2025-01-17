<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //dd($request);
        //dd($request->get('username'));

        //Modificar el request
        $request->request->add(['username' => Str::slug($request->username)]);

        //Validacion de formularios
        $request->validate([
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);

        //Autenticar un usuario
        //auth()->attempt([
        //    'email' => $request->email,
        //   'password' => $request->password
        //]);

        //Otra forma de autentificar
        auth()->attempt($request->only('email', 'password'));

        //Redireccion al usuario
        return redirect()->route('posts.index', ['user' => $request->username]);
    }
}
