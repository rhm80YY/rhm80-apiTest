<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mi App Laravel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    @stack('styles') {{-- Por si alguna vista necesita CSS extra --}}
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="font-bold text-lg">Laravel Demo</a>

            <div class="space-x-4">
                <a href="{{ url('/posts') }}" class="hover:underline">Posts</a>
                {{-- Agregá más enlaces si querés --}}
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="container mx-auto p-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-200 text-center p-4 mt-10">
        <p class="text-sm text-gray-600">&copy; {{ date('Y') }} - Mi App Laravel</p>
    </footer>

    @stack('scripts') {{-- Por si alguna vista necesita JS extra --}}
</body>
</html>