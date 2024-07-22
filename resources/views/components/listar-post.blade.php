<div>
    @if ($posts->count())

        <div class="grid grid-cols-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-1">
            @foreach ($posts as $post)
                <div class="relative overflow-hidden border border-gray-300 rounded-lg" style="padding-bottom: 100%;">
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}"
                            class="absolute inset-0 w-full h-full object-cover">
                    </a>
                </div>
            @endforeach
        </div>


        <div class="my-10">
            {{ $posts->links('pagination::tailwind') }}
        </div>

    @else
        <p class="text-center">No hay publicaciones, sigue a alguien para poder mostrar sus publicaciones</p>
    @endif
</div>
