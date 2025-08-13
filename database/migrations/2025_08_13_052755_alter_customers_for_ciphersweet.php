// /home/gunreip/code/tafel-wesseling/database/migrations/xxxx_xx_xx_xxxxxx_alter_customers_for_ciphersweet.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // TEXT-Spalten für CipherSweet (verschlüsselte Felder sollten TEXT sein)
        Schema::table('customers', function (Blueprint $table) {
            DB::statement('ALTER TABLE customers ALTER COLUMN first_name TYPE text');
            DB::statement('ALTER TABLE customers ALTER COLUMN last_name TYPE text');
            DB::statement('ALTER TABLE customers ALTER COLUMN email TYPE text');
            DB::statement('ALTER TABLE customers ALTER COLUMN phone TYPE text');
            DB::statement('ALTER TABLE customers ALTER COLUMN birth_city_name TYPE text');
            DB::statement('ALTER TABLE customers ALTER COLUMN notes TYPE text');
        });

        // Alte, nun unnötige BI-Spalten entfernen (wir nutzen blind_indexes-Tabelle des Pakets)
        Schema::table('customers', function (Blueprint $table) {
            foreach (['last_name_bi_eq','last_name_bi_sw3','email_bi_eq'] as $col) {
                if (Schema::hasColumn('customers', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }

    public function down(): void
    {
        // Down: zurück zu VARCHAR (vereinfachte Defaults)
        Schema::table('customers', function (Blueprint $table) {
            DB::statement("ALTER TABLE customers ALTER COLUMN first_name TYPE varchar(255)");
            DB::statement("ALTER TABLE customers ALTER COLUMN last_name TYPE varchar(255)");
            DB::statement("ALTER TABLE customers ALTER COLUMN email TYPE varchar(191)");
            DB::statement("ALTER TABLE customers ALTER COLUMN phone TYPE varchar(40)");
            DB::statement("ALTER TABLE customers ALTER COLUMN birth_city_name TYPE varchar(120)");
            DB::statement("ALTER TABLE customers ALTER COLUMN notes TYPE text"); // war schon textnah
        });

        // BI-Spalten wiederherstellen (Minimal)
        Schema::table('customers', function (Blueprint $table) {
            if (!Schema::hasColumn('customers','last_name_bi_eq')) $table->string('last_name_bi_eq',128)->nullable();
            if (!Schema::hasColumn('customers','last_name_bi_sw3')) $table->string('last_name_bi_sw3',128)->nullable();
            if (!Schema::hasColumn('customers','email_bi_eq')) $table->string('email_bi_eq',128)->nullable();
        });
    }
};
