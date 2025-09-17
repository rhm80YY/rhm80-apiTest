<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Article;

class SyncArticles extends Command
{
    protected $signature = 'articles:sync';
    protected $description = 'Sincroniza artículos de noticias desde NewsAPI';

    public function handle(): void
    {
        $this->info('🔄 Descargando artículos de NewsAPI...');

        $response = Http::withHeaders([
            'X-Api-Key' => config('services.newsapi.token'),
        ])->get(config('services.newsapi.url'), [
            'country' => config('services.newsapi.country'),
        ]);

        if ($response->failed()) {
            $this->error('❌ Error al conectar con NewsAPI: ' . $response->status());
            return;
        }

        $articles = $response->json()['articles'] ?? [];
        $count = 0;

        foreach ($articles as $a) {
            Article::updateOrCreate(
                ['url' => $a['url']], // clave única
                [
                    'source'      => $a['source']['name'] ?? null,
                    'author'      => $a['author'],
                    'title'       => $a['title'],
                    'description' => $a['description'],
                    'urlToImage'  => $a['urlToImage'],

                    // 👇 corrección aquí
                    'publishedAt' => isset($a['publishedAt'])
                        ? \Carbon\Carbon::parse($a['publishedAt'])->format('Y-m-d H:i:s')
                        : null,

                    'content'     => $a['content'],
                ]
            );
            $count++;
        }

        $this->info("✅ Se sincronizaron {$count} artículos.");
    }
}
