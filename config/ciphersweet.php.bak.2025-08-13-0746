<?php
// /home/gunreip/code/tafel-wesseling/config/ciphersweet.php

return [

    /*
    |--------------------------------------------------------------------------
    | Backend
    |--------------------------------------------------------------------------
    | Üblich: "nacl" (libsodium). Alternativen: "boring", "fips", "custom".
    */
    'backend' => env('CIPHERSWEET_BACKEND', 'nacl'),

    /*
    |--------------------------------------------------------------------------
    | Provider (Kompatibilität)
    |--------------------------------------------------------------------------
    | Einige Versionen lesen hieraus (string/file/random/custom) + providers.
    */
    'provider' => env('CIPHERSWEET_PROVIDER', 'string'),

    'providers' => [
        'file' => [
            'path' => env('CIPHERSWEET_FILE_PATH'),
        ],
        'string' => [
            // Primärer Key-Pfad: aus .env
            'key' => env('CIPHERSWEET_KEY'),
        ],
        // 'custom' => \App\Crypto\CustomKeyProviderFactory::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Direktzugriff (Kompatibilität)
    |--------------------------------------------------------------------------
    | Manche Komponenten erwarten 'key' oder 'keys.default'.
    */
    'key' => env('CIPHERSWEET_KEY'),

    'keys' => [
        'default' => env('CIPHERSWEET_KEY'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Leerwerte erlauben (Paket-spezifisch)
    |--------------------------------------------------------------------------
    */
    'permit_empty' => env('CIPHERSWEET_PERMIT_EMPTY', false),
];
