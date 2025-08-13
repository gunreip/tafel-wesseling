<?php
// /home/gunreip/code/tafel-wesseling/database/migrations/2025_08_13_113142_recreate_blind_indexes_with_uuid.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('blind_indexes');

        Schema::create('blind_indexes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('indexable_type'); // z. B. App\Models\Customer
            $table->uuid('indexable_id');     // UUID statt BIGINT
            $table->string('name');           // last_name_eq, email_eq, ...
            $table->binary('value');          // BYTEA
            $table->timestamps();

            $table->index(['indexable_type', 'indexable_id']);
            $table->index(['name', 'value']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blind_indexes');
    }
};
