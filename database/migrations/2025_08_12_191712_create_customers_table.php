<?php // database/migrations/2025_08_12_191712_create_customers_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));

            $table->string('customer_no', 32)->unique(); // eigene Kundennummer

            // Personenbezogene Felder (werden später via CipherSweet verschlüsselt)
            $table->string('first_name', 100);
            $table->string('last_name', 100);

            // Blind Indexes für Suche nach Nachnamen
            $table->string('last_name_bi_eq', 128)->index();
            $table->string('last_name_bi_sw3', 128)->index(); // Prefix (3 Zeichen)

            // Optional suchbar (exakt) über BI
            $table->string('email', 191)->nullable();
            $table->string('email_bi_eq', 128)->nullable()->index();

            $table->string('phone', 40)->nullable();

            // Geburtsdaten
            $table->date('birth_date')->nullable();
            $table->string('birth_city_name', 120)->nullable();
            $table->char('birth_country_iso2', 2)->nullable();

            // Status & Notizen
            $table->boolean('is_active')->default(true);
            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('birth_country_iso2')->references('iso2')->on('countries')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
