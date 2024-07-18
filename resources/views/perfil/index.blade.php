@extends('layouts.app')

@section('titulo')
Editar Perfil: {{auth()->user()->username}}
@endsection

@section('contenido')
<div class="md:flex md:justify-center">
    <div class="md:w-1/2 bg-white shadow p-6">
        <form action="{{route('perfil.store')}}" class="md:mt-0" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-5">
                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Nombre de Usuario</label>
                <input class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" type="text"
                    name="username" id="username" placeholder="Tu Nombre de Usuario"
                    value="{{ auth()->user()->username }}" />

                @error('username')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center font-bold">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">Imagen Perfil</label>
                <input class="border p-3 w-full rounded-lg" type="file" name="imagen" id="imagen" value=""
                    accept=".jpg, .jpeg, .png" />
            </div>

            <input type="submit" value="Guardar Cambios"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
        </form>
    </div>
</div>
@endsection