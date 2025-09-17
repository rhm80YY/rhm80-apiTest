<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Artisan;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('publishedAt', 'desc')->paginate(9);
        return view('articles.index', compact('articles'));
    }

    public function sync()
    {
        // Ejecutar el comando de sincronización
        Artisan::call('articles:sync');
        
        return redirect()->route('articles.index')
            ->with('success', '¡Noticias actualizadas correctamente!');
    }
}
