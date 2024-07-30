@extends('layouts.app')

@section('titulo')
{{ $post->titulo }}
@endsection

@section('contenido')
<div class="container mx-auto md:flex">
    <div class="md:w-1/2">

        <img src="{{ asset('uploads' . '/' . $post->imagen) }}" alt="Imagen del post {{ $post->titulo }}"
            class="rounded-lg object-cover">

        <div class="p-3 flex items-center gap-4">
            @auth

                <livewire:like-post :post="$post" />

            @endauth
        </div>
        <div class="p-3 gap-4">
            <p class="font-bold text-xl">{{ $post->user->username }}</p>
            <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
            <p class="mt-5 text-md">{{ $post->descripcion }}</p>
        </div>

        @auth
            @if ($post->user_id === auth()->user()->id)
                <div class="p-3 gap-4">
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        @method('DELETE') <!-- Metodo Spoofing -->
                        @csrf
                        <input type="submit" value="Eliminar publicacion"
                            class="bg-red-400 hover:bg-red-500 text-white font-bold py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded cursor-pointer">
                    </form>
                </div>
            @endif
        @endauth

    </div>
    <div class="md:w-1/2 p-5">
        <div class="shadpw bg-white pt-5 pr-5 pl-5 pb-1 mb-5 rounded-md">

            @auth
                @if (session('mensaje'))
                    <div class="bg-green-700 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                        {{ session('mensaje') }}
                    </div>
                @endif

                <!--Formulario de comentarios -->

                <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">Añade un
                            Comentario</label>
                        <textarea name="comentario" id="comentario" placeholder="Agrega un comentario" class="border p-3 w-full rounded-lg 
                                                                                           @error('comentario')
                                                                                            border-red-500
                                                                                        @enderror"></textarea>
                        @error('comentario')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center font-bold">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <input type="submit" value="Publicar Comentario"
                        class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded cursor-pointer w-full uppercase">
                </form>
            @endauth

            <div class="bg-white shadow mb-5 max-h-97 overpflow-y-scroll mt-10 rounded-md border border-gray-300">
                @if ($post->comentarios->count())
                    @foreach ($comentarios as $comentario)
                        <div class="p-5 border-gray-300 border-b flex flex-row">
                            <div class="flex items-center">
                                <img src="{{ $comentario->user->imagen ? asset('storage/' . $comentario->user->imagen) : asset('img/usuario.svg') }}"
                                    alt="" class="rounded-full h-12 w-12 mr-2 object-cover">
                            </div>
                            <div>
                                <a href="{{ route('posts.index', $comentario->user) }}"
                                    class="font-bold">{{ $comentario->user->username }}</a>
                                <p>{{ $comentario->comentario }}</p>
                                <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                    <div class="my-5 px-10">
                        {{ $comentarios->links('pagination::tailwind') }}
                    </div>
                @else
                    <p class="p-10 text-center">No Hay Comentarios Aun</p>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection