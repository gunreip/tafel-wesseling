<?php
// /home/gunreip/code/tafel-wesseling/database/migrations/2025_08_13_111524_ensure_pg_uuid_extension.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // pgcrypto liefert gen_random_uuid(); alternativ: uuid-ossp (uuid_generate_v4())
        DB::statement('CREATE EXTENSION IF NOT EXISTS "pgcrypto";');
    }
    public function down(): void
    {
        // Extension lassen wir i.d.R. installiert (keine Down-Action)
    }
};
