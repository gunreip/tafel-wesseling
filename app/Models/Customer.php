<?php
// /home/gunreip/code/tafel-wesseling/app/Models/Customer.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

// Spatie CipherSweet
use Spatie\LaravelCipherSweet\Concerns\UsesCipherSweet;
use Spatie\LaravelCipherSweet\Contracts\CipherSweetEncrypted;
use ParagonIE\CipherSweet\EncryptedRow;
use ParagonIE\CipherSweet\BlindIndex;

class Customer extends Model implements CipherSweetEncrypted
{
    use HasFactory, HasUuids, UsesCipherSweet;

    protected $table = 'customers';

    // UUID-Primärschlüssel
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'customer_no',
        'first_name',
        'last_name',
        'email',
    ];

    /**
     * CipherSweet-Felder & Blind-Index-Definitionen.
     * last_name & email werden verschlüsselt; Exact-Match-Blind-Indices werden erzeugt.
     */
    public static function configureCipherSweet(EncryptedRow $row): void
    {
        // Verschlüsselbare Felder
        $row->addField('last_name');
        $row->addField('email');

        // Exact-Match Blind-Indices
        $row->addBlindIndex('last_name', new BlindIndex('last_name_eq', [], 256, true));
        $row->addBlindIndex('email',     new BlindIndex('email_eq',     [], 256, true));
    }
}
