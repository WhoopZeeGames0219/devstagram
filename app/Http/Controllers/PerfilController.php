<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        try {
            $request->request->add(['username' => Str::slug($request->username)]);

            $request->validate([
                'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20', 'not_in:editar-perfil'],
                'imagen' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:10240'], // 10MB
            ]);

            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $nombreImagen = Str::uuid() . "." . $imagen->extension();
                $imagen->storeAs($nombreImagen);
            }

            $usuario = User::find(auth()->user()->id);
            $usuario->username = $request->username;
            $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;

            $usuario->save();

            return redirect()->route('posts.index', $usuario->username);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException('Usuario no encontrado');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error inesperado. Por favor, inténtalo de nuevo.']);
        }
    }

}