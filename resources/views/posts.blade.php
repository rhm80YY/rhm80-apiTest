@extends('layouts.app')

@section('title', 'Listado de Posts')

@section('content')
    <h1 class="text-3xl font-bold mb-6">📌 Posts desde API</h1>

    <!-- 🔎 Buscador -->
    <form method="GET" action="{{ url('/posts') }}" class="mb-6 flex gap-2">
        <input type="text" name="search" value="{{ $search ?? '' }}"
               placeholder="Buscar por título..."
               class="w-full p-2 border rounded">

        <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded">
            Buscar
        </button>

        @if(!empty($search))
            <a href="{{ url('/posts') }}"
               class="bg-gray-400 text-white px-4 py-2 rounded">
                Limpiar
            </a>
        @endif
    </form>

    <!-- 📄 Tarjetas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($posts as $post)
            <div class="bg-white rounded-xl shadow-md p-4">
                <h2 class="text-xl font-semibold text-blue-600 mb-2">
                    {{ $post['title'] }}
                </h2>
                <p class="text-gray-600 mb-3">{{ $post['body'] }}</p>
                <a href="{{ url('/posts/'.$post['id']) }}" 
                   class="text-sm text-white bg-blue-500 px-3 py-1 rounded">
                    Ver más
                </a>
            </div>
        @endforeach
    </div>

    <!-- 📄 Paginación -->
    <div class="mt-6">
        {{ $posts->appends(['search' => $search])->links() }}
    </div>
@endsection