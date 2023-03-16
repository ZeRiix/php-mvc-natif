<?php

//config app

return [
    'app' => [
        'name' => 'My App',
        'url' => 'http://localhost:8000',
        'locale' => 'fr',
        'timezone' => 'Europe/Paris',
        'key' => 'base64:YXNkZmFzZGZhc2RmYXNkZmFzZGZhc2RmYXNkZg==',
        'cipher' => 'AES-256-CBC',
        'env' => 'local',
        'debug' => true,
        'log' => 'single',
        'log_level' => 'debug',
        'providers' => [
            \App\Providers\AppServiceProvider::class,
            \App\Providers\RouteServiceProvider::class,
        ],
    ],
    ];