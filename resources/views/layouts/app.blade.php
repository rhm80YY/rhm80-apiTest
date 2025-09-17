<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mi App')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="bg-blue-600 p-4 text-white">
        <a href="{{ route('products.index') }}" class="font-bold">Productos</a>
        <a href="{{ route('articles.index') }}" class="font-bold">Articles</a>
    </nav>

    <main class="container mx-auto p-6">
        @yield('content')
    </main>
</body>
</html>