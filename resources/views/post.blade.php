@extends('layouts.app')

@section('title', $post['title'])

@section('content')
    <a href="{{ url('/posts') }}" class="text-blue-500 mb-4 inline-block">
        ⬅ Volver a la lista
    </a>

    <div class="bg-white rounded-xl shadow-md p-6">
        <h1 class="text-3xl font-bold text-blue-600 mb-4">
            {{ $post['title'] }}
        </h1>
        <p class="text-gray-700">{{ $post['body'] }}</p>
    </div>
@endsection