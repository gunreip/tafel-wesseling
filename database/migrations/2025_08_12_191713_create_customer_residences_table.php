<?php // database/migrations/2025_08_12_191713_create_customer_residences_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('customer_residences', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->uuid('customer_id')->unique(); // 1:1

            // Wohnsitz-Felder (werden später verschlüsselt)
            $table->string('residence_street', 120);
            $table->string('residence_house_number', 20);
            $table->string('address_addition', 120)->nullable();
            $table->string('residence_zipcode', 15);
            $table->string('residence_city_name', 120);
            $table->char('residence_country_iso2', 2)->default('DE');

            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->cascadeOnDelete();
            $table->foreign('residence_country_iso2')->references('iso2')->on('countries');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_residences');
    }
};
