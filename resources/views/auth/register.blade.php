@extends('layouts.app')

@section('titulo')
Registrate en Devstagram
@endsection

@section('contenido')
<div class="md:flex md:justify-center md:gap-10 md:items-center">

    <div class="md:w-6/12 p-5">
        <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen registro de usuarios">
    </div>

    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
        <form action="{{ route('register') }}" method="POST" novalidate>
            @csrf
            <div class="mb-5">
                <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                <input class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" type="text"
                    name="name" id="name" placeholder="Tu nombre" value="{{ old('name') }}" />

                @error('name')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center font-bold">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                <input class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" type="text"
                    name="username" id="username" placeholder="Tu nombre de Usuario" value="{{ old('username') }}" />

                @error('username')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center font-bold">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Correo Electronico</label>
                <input class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" type="email"
                    name="email" id="email" placeholder="Tu Email de Registro" value="{{ old('email') }}" />

                @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center font-bold">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Contraseña</label>
                <input class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror" type="password"
                    name="password" id="password" placeholder="Password de Registro" />

                @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center font-bold">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Repetir
                    Contraseña</label>
                <input class="border p-3 w-full rounded-lg" type="password" name="password_confirmation"
                    id="password_confirmation" placeholder="Repite tu Password" />
            </div>

            <input type="submit" value="Crear Cuenta"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
        </form>
    </div>

</div>
@endsection