@extends('layouts.app')

@section('title', $product->title)

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <img src="{{ $product->image }}" alt="{{ $product->title }}" class="w-64 h-64 object-contain mb-4">
        <h1 class="text-2xl font-bold">{{ $product->title }}</h1>
        <p class="text-gray-700 mt-2">{{ $product->description }}</p>
        <p class="mt-2 text-blue-600 font-bold text-xl">${{ number_format($product->price, 2) }}</p>
        <p class="mt-1 text-sm">Categoría: {{ $product->category }}</p>
        <p class="mt-1">⭐ {{ $product->rating_rate }} ({{ $product->rating_count }} reseñas)</p>
        <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-gray-500 text-white px-4 py-2 rounded">Volver</a>
    </div>
@endsection
