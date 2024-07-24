@extends('layouts.app')

@section('titulo')
Muro de {{ $user->username }}
@endsection

@section('contenido')
<div class="flex justify-center">
    <div class="w-full md:6/12 lg:w-6/12 flex flex-col items-center md:flex-row lg:justify-center">
        <div class="md:w-6/12 lg:w-10/12 px-5 flex justify-center">
            <div class="profile-container">
                <img src="{{ $user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('img/usuario.svg') }}"
                    alt="Imagen usuario" class="profile-image" />
            </div>
        </div>
        <div
            class="md:w-8/12 lg:w-8/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
            <div class="flex items-center gap-2">
                <p class="text-gray-700 text-3xl text-bold">{{ $user->username }}</p>
                @auth
                    @if ($user->id === auth()->user()->id)
                        <a href="{{ route('perfil.index') }}" class="text-gray-500 hover:text-gray-600 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                stroke="currentColor" class="size-8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>

                        </a>
                    @endif
                @endauth
            </div>
            <p class="text-gray-800 text-xl mb-3 font-bold mt-5">
                {{ $user->followers->count() }}
                <span class="font-normal"> @choice('Seguidor|Seguidores', $user->followers->count()) </span>
            </p>

            <p class="text-gray-800 text-xl mb-3 font-bold">
                {{ $user->followings->count() }}
                <span class="font-normal"> Siguiendo </span>
            </p>

            <p class="text-gray-800 text-xl mb-3 font-bold">
                @if ($user->posts->count() == 1)
                    {{ $user->posts->count() }}
                    <span class="font-normal">Post</span>
                @else
                    {{ $user->posts->count() }}
                    <span class="font-normal">Posts</span>
                @endif
            </p>

            @auth
                @if ($user->id !== auth()->user()->id)
                    @if (!$user->isFollowing(auth()->user()))
                        <form action="{{ route('users.follow', $user) }}" method="post">
                            @csrf
                            <input type="submit"
                                class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded cursor-pointer"
                                value="Seguir" />
                        </form>
                    @else
                        <form action="{{ route('users.unfollow', $user) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit"
                                class="bg-red-400 hover:bg-red-500 text-white font-bold py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded cursor-pointer"
                                value="Dejar de seguir" />
                        </form>
                    @endif
                @endif
            @endauth
        </div>
    </div>
</div>

<section class="container mx-auto mt-10">
    <h2 class="text-4xl text-center font-black my-10 flex items-center justify-center gap-2"
        style="font-family: 'AbadiMT'">
        Publicaciones
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
        </svg>
    </h2>
    <x-listar-post :posts="$posts" />
</section>
@endsection