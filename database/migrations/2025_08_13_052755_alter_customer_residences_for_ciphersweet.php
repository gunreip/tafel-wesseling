// /home/gunreip/code/tafel-wesseling/database/migrations/xxxx_xx_xx_xxxxxx_alter_customer_residences_for_ciphersweet.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('customer_residences', function (Blueprint $table) {
            DB::statement('ALTER TABLE customer_residences ALTER COLUMN residence_street TYPE text');
            DB::statement('ALTER TABLE customer_residences ALTER COLUMN residence_house_number TYPE text');
            DB::statement('ALTER TABLE customer_residences ALTER COLUMN address_addition TYPE text');
            DB::statement('ALTER TABLE customer_residences ALTER COLUMN residence_zipcode TYPE text');
            DB::statement('ALTER TABLE customer_residences ALTER COLUMN residence_city_name TYPE text');
        });
    }

    public function down(): void
    {
        Schema::table('customer_residences', function (Blueprint $table) {
            DB::statement("ALTER TABLE customer_residences ALTER COLUMN residence_street TYPE varchar(120)");
            DB::statement("ALTER TABLE customer_residences ALTER COLUMN residence_house_number TYPE varchar(20)");
            DB::statement("ALTER TABLE customer_residences ALTER COLUMN address_addition TYPE varchar(120)");
            DB::statement("ALTER TABLE customer_residences ALTER COLUMN residence_zipcode TYPE varchar(15)");
            DB::statement("ALTER TABLE customer_residences ALTER COLUMN residence_city_name TYPE varchar(120)");
        });
    }
};
