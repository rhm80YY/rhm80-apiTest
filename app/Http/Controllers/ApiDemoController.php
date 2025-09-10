<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class ApiDemoController extends Controller
{
    // public function posts()
    // {
    //     // Consumimos API pública de JSONPlaceholder
    //     $response = Http::get('https://jsonplaceholder.typicode.com/posts');
    //     $posts = $response->json();

    //     // Retornamos una variable a la vista
    //     return view('posts', ['posts' => $posts]);

    //     // Retornamos el JSON directo como respuesta
    //     // return $response->json();
    // }

    public function posts(Request $request)
    {
        // Consumimos la API
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
        $posts = collect($response->json()); // convertimos en Collection

        // 🔎 Filtro por búsqueda
        if ($request->has('search') && !empty($request->search)) {
            $search = strtolower($request->search);
            $posts = $posts->filter(function ($post) use ($search) {
                return str_contains(strtolower($post['title']), $search);
            });
        }

        // 📄 Paginación
        $perPage = 10;
        $page = $request->get('page', 1);
        $items = $posts->slice(($page - 1) * $perPage, $perPage)->values();

        $paginator = new LengthAwarePaginator(
            $items,
            $posts->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('posts', [
            'posts' => $paginator,
            'search' => $request->search
        ]);
    }

    public function post($id)
    {
        // Traer un post por ID
        $response = Http::get("https://jsonplaceholder.typicode.com/posts/{$id}");
        $post = $response->json();

        // Retornamos una variable a la vista
        return view('post', ['post' => $post]);

        // Retornamos el JSON directo como respuesta
        // return $response->json();
    }
}