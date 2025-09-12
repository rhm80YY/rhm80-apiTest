<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $response = Http::get('https://fakestoreapi.com/products');

        if ($response->successful()) {
            $products = $response->json();

            foreach ($products as $product) {
                DB::table('products')->insert([
                    'id'           => $product['id'],
                    'title'        => $product['title'],
                    'price'        => $product['price'],
                    'description'  => $product['description'],
                    'category'     => $product['category'],
                    'image'        => $product['image'],
                    'rating_rate'  => $product['rating']['rate'] ?? null,
                    'rating_count' => $product['rating']['count'] ?? null,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);
            }
        }
    }
}
