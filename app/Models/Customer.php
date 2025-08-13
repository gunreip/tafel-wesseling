<?php
// /home/gunreip/code/tafel-wesseling/app/Models/Customer.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ParagonIE\CipherSweet\BlindIndex;
use ParagonIE\CipherSweet\EncryptedRow;
use Spatie\LaravelCipherSweet\Concerns\UsesCipherSweet;
use Spatie\LaravelCipherSweet\Contracts\CipherSweetEncrypted;

class Customer extends Model implements CipherSweetEncrypted
{
    use SoftDeletes;
    use UsesCipherSweet;

    protected $table = 'customers';

    protected $fillable = [
        'customer_no',
        'first_name',
        'last_name',
        'email',
        'phone',
        'birth_date',
        'birth_city_name',
        'birth_country_iso2',
        'is_active',
        'notes',
    ];

    /**
     * CipherSweet-Felder & Blind-Indexes (Exact-Match).
     */
    public static function configureCipherSweet(EncryptedRow $row): void
    {
        $row
            ->addTextField('first_name')
            ->addTextField('last_name')
            ->addOptionalTextField('email')
            ->addOptionalTextField('phone')
            ->addOptionalTextField('birth_city_name')
            ->addOptionalTextField('notes')
            ->addBlindIndex('last_name', new BlindIndex('last_name_eq'))
            ->addBlindIndex('email', new BlindIndex('email_eq'));
    }
}
