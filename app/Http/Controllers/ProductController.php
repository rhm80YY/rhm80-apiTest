<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Listado con paginación
    public function index(Request $request)
    {
        $query = Product::query();

        // Búsqueda opcional por título o categoría
        if ($request->filled('search')) {
            $query->where('title', 'like', "%{$request->search}%")
                  ->orWhere('category', 'like', "%{$request->search}%");
        }

        $products = $query->paginate(10)->withQueryString();

        return view('products.index', compact('products'));
    }

    // Mostrar detalle
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
