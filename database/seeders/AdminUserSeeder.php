<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = 'admin@tafel-wesseling.local';
        $password = 'ChangeMe123!'; // Bitte nach erstem Login ändern
        $now = now();

        DB::table('users')->updateOrInsert(
            ['email' => $email],
            [
                'name' => 'Admin',
                'password' => Hash::make($password),
                'role' => 'admin',
                'email_verified_at' => $now,
                'remember_token' => Str::random(20),
                'updated_at' => $now,
                'created_at' => $now,
            ]
        );
    }
}
