<?php
// (auto) database/migrations/XXXX_XX_XX_XXXXXX_create_blind_indexes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('blind_indexes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('indexable_type');   // z.B. App\Models\Customer
            $table->uuid('indexable_id');       // passt zu UUID PK
            $table->string('name');             // z.B. last_name_eq, email_eq
            $table->binary('value');            // PostgreSQL: BYTEA
            $table->timestamps();

            $table->index(['indexable_type', 'indexable_id'], 'blind_indexes_type_id_idx');
            $table->index(['name', 'value'], 'blind_indexes_name_value_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blind_indexes');
    }
};
