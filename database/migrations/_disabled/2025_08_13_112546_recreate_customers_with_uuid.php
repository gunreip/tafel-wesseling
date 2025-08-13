<?php
// /home/gunreip/code/tafel-wesseling/database/migrations/2025_08_13_112546_recreate_customers_with_uuid.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('customers');

        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();          // UUID PK
            $table->string('customer_no')->unique(); // z. B. DEV-0001
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
