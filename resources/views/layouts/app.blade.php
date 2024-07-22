<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('styles')
    <title>Devstagram - @yield('titulo')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @livewireStyles
</head>

<style>
    .profile-container {
        width: 300px;
        height: 300px;
        border-radius: 50%;
        overflow: hidden;
    }

    .profile-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Tamaño para pantallas pequeñas */
    @media (min-width: 640px) {
        .profile-container {
            width: 300px;
            height: 300px;
        }
    }

    /* Tamaño para pantallas medianas */
    @media (min-width: 768px) {
        .profile-container {
            width: 350px;
            height: 350px;
        }
    }

    /* Tamaño para pantallas grandes */
    @media (min-width: 1024px) {
        .profile-container {
            width: 380px;
            height: 380px;
        }
    }
</style>

<body class="bg-gray-100">

    <header class="p-5 border-b bg-white shadow">
        <div class="mx-auto">
            <nav class="border-gray-200 px-2">
                <div class="container mx-auto flex flex-wrap items-center justify-between">
                    <a href="{{ route('home') }}" class="text-3xl font-black">DevStagram</a>
                    <div class="flex md:hidden">
                        <button data-collapse-toggle="mobile-menu-3" type="button"
                            class="text-gray-400 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-300 rounded-lg inline-flex items-center justify-center"
                            aria-controls="mobile-menu-3" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>

                    @auth
                        <div class="hidden w-full md:flex md:w-auto md:order-2" id="mobile-menu-3">
                            <ul
                                class="flex flex-col md:flex-row md:space-x-8 mt-4 md:mt-0 md:text-sm md:font-medium ml-auto md:items-center">
                                <li>
                                    <a href="{{route('posts.create')}}"
                                        class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded-lg text-base uppercase font-bold cursor-pointer hover:text-black">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                                        </svg>
                                        Crear
                                    </a>
                                </li>
                                <li class="py-1">
                                    <a class="font-bold text-gray-600 text-base border p-2 gap-2 flex rounded-lg hover:text-black"
                                        href="{{route('posts.index', auth()->user()->username)}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                        <span class="font-normal ">{{auth()->user()->username}}</span></a>
                                </li>
                                <li>
                                    <form method="POST" action="{{route('logout')}}"
                                        class="border p-2 gap-2 flex rounded-lg ">
                                        @csrf
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                        </svg>

                                        <button class="font-bold uppercase text-gray-600 text-base hover:text-black"
                                            type="submit">Cerrar
                                            Sesión</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endauth

                    @guest
                        <div class="hidden w-full md:flex md:w-auto md:order-2" id="mobile-menu-3">
                            <ul
                                class="flex flex-col md:flex-row md:space-x-8 mt-4 md:mt-0 md:text-sm md:font-medium ml-auto">
                                <li>
                                    <a class="font-bold uppercase text-gray-600 text-base border rounded-lg p-2 gap-2 flex md:border-none"
                                        href="{{ route('login') }}">Iniciar sesion</a>
                                </li>
                                <li>
                                    <a class="font-bold uppercase text-gray-600 text-base border rounded-lg p-2 gap-2 flex md:border-none"
                                        href="{{ route('register') }}">Crear Cuenta</a>
                                </li>
                            </ul>
                        </div>
                    @endguest

                </div>
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10" style="font-family: 'AbadiMT';">@yield('titulo')</h2>
        @yield('contenido')
    </main>

    <footer class="mt-10 text-center p-5 text-gray-600 font-bold uppercase">
        Devstagram - Todos los derechos reservados {{ now()->year }}
    </footer>

    @livewireScripts

    <script src="{{ asset('js/flowbite.js') }}"></script>
</body>

</html>
