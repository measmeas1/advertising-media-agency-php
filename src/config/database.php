<?php

function env($key, $default = null)
{
    static $env;

    if (!$env) {
        $env = parse_ini_file(__DIR__ . '/../../.env');
    }

    return $env[$key] ?? $default;
}

return [
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '3306'),
    'dbname' => env('DB_NAME'),
    'user' => env('DB_USER'),
    'pass' => env('DB_PASS'),
];
