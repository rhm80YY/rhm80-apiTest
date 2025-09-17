<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Programar sincronización de artículos
Schedule::command('articles:sync')
    ->hourly() // Ejecutar cada hora
    ->withoutOverlapping() // Evitar que se ejecute si ya está corriendo
    ->runInBackground(); // Ejecutar en segundo plano
