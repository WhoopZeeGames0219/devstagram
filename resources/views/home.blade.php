@extends('layouts.app')

@section('titulo')
Página Principal
@endsection

@section('contenido')
<h1 class="text-xl text-center my-8 text-gray-600 font-bold uppercase" style="font-family: 'AbadiMT'">Personas que
    quizas
    conozcas</h1>
<div class="container flex flex-row justify-start gap-4 overflow-x-auto py-4 pt-2 pb-8">
    @foreach ($users as $user)
        <div class="flex-shrink-0 flex flex-col items-center">
            <a href="{{ route('posts.index', ['user' => $user]) }}">
                <img src="{{ $user->imagen ? asset('storage') . '/' . $user->imagen : asset('img/usuario.svg') }}" alt=""
                    class="border border-gray-300 rounded-lg object-cover w-40 h-48">
                <p class="border border-gray-400 text-center w-full px-2 py-1 mt-2 break-words rounded-sm">
                    {{ $user->username }}
                </p>
            </a>
        </div>
    @endforeach
</div>

<h1 class="container flex justify-center p-5 flex-wrap text-xl text-center mb-4  text-gray-600 font-bold uppercase"
    style="font-family: 'AbadiMT'">
    Publicaciones
    de
    personas
    que sigues</h1>

<x-listar-post :posts="$posts" />
@endsection