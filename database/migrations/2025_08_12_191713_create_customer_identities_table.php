<?php // database/migrations/2025_08_12_191713_create_customer_identities_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('customer_identities', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->uuid('customer_id');

            // z. B. 'social_number' | 'entitlement_number'
            $table->string('identity_type', 32);

            // Wert wird später verschlüsselt gespeichert
            $table->text('identity_value');

            // Blind Index für exakte Suche / Duplikat-Vermeidung je Typ
            $table->string('identity_bi_eq', 128);

            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->cascadeOnDelete();
            $table->index('customer_id');
            $table->unique(['identity_type', 'identity_bi_eq']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_identities');
    }
};
