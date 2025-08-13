<?php
// /home/gunreip/code/tafel-wesseling/config/ciphersweet.php
return [
    'backend'   => 'nacl',
    'provider'  => env('CIPHERSWEET_PROVIDER', 'file'),
    'providers' => [
        'file'   => ['path' => env('CIPHERSWEET_FILE_PATH', '/home/gunreip/.config/tafel-wesseling/ciphersweet.key')],
        'string' => ['key'  => env('CIPHERSWEET_KEY', '')], // leer lassen
    ],
    'permit_empty' => false,
    // folgende Felder leeren, damit NICHT versehentlich der string-provider greift
    'key'  => '',
    'keys' => ['default' => ''],
];
