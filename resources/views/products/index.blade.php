@extends('layouts.app')

@section('title', 'Listado de Productos')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Productos</h1>

    <!-- Buscador -->
    <form method="GET" action="{{ route('products.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="search" value="{{ request('search') }}" 
               placeholder="Buscar producto..." 
               class="border p-2 rounded w-1/3">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Buscar</button>
        @if(request('search'))
            <a href="{{ route('products.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Limpiar</a>
        @endif
    </form>

    <!-- Listado -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($products as $product)
            <div class="bg-white p-4 rounded shadow">
                <img src="{{ $product->image }}" alt="{{ $product->title }}" class="w-full h-48 object-contain mb-3">
                <h2 class="text-lg font-bold">{{ $product->title }}</h2>
                <p class="text-sm text-gray-600">{{ $product->category }}</p>
                <p class="text-blue-600 font-bold">${{ number_format($product->price, 2) }}</p>
                <p class="text-sm">⭐ {{ $product->rating_rate }} ({{ $product->rating_count }} reseñas)</p>
                <a href="{{ route('products.show', $product) }}" 
                   class="mt-2 inline-block bg-blue-500 text-white px-4 py-2 rounded">Ver detalle</a>
            </div>
        @endforeach
    </div>

    <!-- Paginación -->
    <div class="mt-6">
        {{ $products->links() }}
    </div>
@endsection
