<?php
// /home/gunreip/code/tafel-wesseling/app/Providers/CipherSweetOverrideServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use ParagonIE\CipherSweet\Backend\BoringCrypto;
use ParagonIE\CipherSweet\CipherSweet;
use ParagonIE\CipherSweet\KeyProvider\StringProvider;

class CipherSweetOverrideServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CipherSweet::class, function () {
            $k = (string) (config('ciphersweet.providers.string.key') ?? config('ciphersweet.key') ?? '');
            if (str_starts_with($k,'base64:')) {
                $raw = base64_decode(substr($k,7), true);
            } elseif (str_starts_with($k,'hex:')) {
                $raw = @hex2bin(substr($k,4));
            } else {
                $raw = $k;
            }
            if (!is_string($raw) || strlen($raw) !== 32) {
                throw new \RuntimeException('CipherSweet master key must be 32 bytes.');
            }
            return new CipherSweet(new StringProvider($raw), new BoringCrypto());
        });
    }
}
