@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-extrabold tracking-tight text-blue-700">Últimas Noticias</h1>
        <div class="flex items-center gap-4">
            <form action="{{ route('articles.sync') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-green-600 text-white text-sm font-medium hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600">
                    🔄 Refrescar Noticias
                </button>
            </form>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-50 text-blue-700">
                Total: {{ $articles->total() }}
            </span>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    ✓
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    @if($articles->count() > 0)
        <!-- Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($articles as $article)
                <div class="bg-white rounded-xl shadow-md overflow-hidden relative flex flex-col">

                    {{-- Fecha encima de la imagen --}}
                    @if($article->publishedAt)
                        <div class="absolute top-2 left-2 bg-blue-600 text-white text-xs px-3 py-1 rounded-full shadow-md">
                            {{ \Carbon\Carbon::parse($article->publishedAt)->format('d M Y') }}
                        </div>
                    @endif

                    {{-- Imagen --}}
                    @if($article->urlToImage)
                        <img src="{{ $article->urlToImage }}" alt="{{ $article->title }}" 
                             class="h-48 w-full object-cover" 
                             onerror="this.style.display='none'">
                    @else
                        <div class="h-48 w-full bg-gray-200 flex items-center justify-center text-gray-400 text-5xl">📰</div>
                    @endif

                    {{-- Contenido --}}
                    <div class="p-5 flex flex-col flex-grow">
                        <h2 class="text-lg font-semibold text-gray-900 mb-2">
                            {{ \Illuminate\Support\Str::limit($article->title, 80) }}
                        </h2>
                        <p class="text-gray-600 text-sm leading-6 flex-1">
                            {{ \Illuminate\Support\Str::limit($article->description ?? 'Sin descripción disponible', 140) }}
                        </p>
                    </div>

                    {{-- Footer con botón --}}
                    <div class="px-5 pb-5 mt-auto">
                        @if($article->url)
                            <a href="{{ $article->url }}" target="_blank" rel="noopener"
                               class="w-full inline-flex items-center justify-center px-4 py-2 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition">
                                Ver más →
                            </a>
                        @else
                            <span class="text-xs text-gray-400">Sin enlace disponible</span>
                        @endif

                        {{-- Fuente y fecha relativa --}}
                        <div class="mt-3 flex items-center justify-between text-xs text-gray-500">
                            <span>{{ $article->source ?? 'Fuente desconocida' }}</span>
                            @if($article->publishedAt)
                                <span>{{ \Carbon\Carbon::parse($article->publishedAt)->diffForHumans() }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginación -->
        <div class="mt-8 flex justify-center">
            {{ $articles->onEachSide(1)->links() }}
        </div>

    @else
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 p-12 text-center">
            <div class="text-6xl mb-4">📰</div>
            <h3 class="text-gray-700 text-xl font-medium">No hay artículos disponibles</h3>
            <p class="text-gray-500">Vuelve más tarde para ver las últimas noticias.</p>
        </div>
    @endif
</div>
@endsection
