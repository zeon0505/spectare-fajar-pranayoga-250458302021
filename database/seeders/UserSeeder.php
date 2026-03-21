<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat atau memperbarui Admin
        User::updateOrCreate(
            ['email' => 'admin@spectare.com'],
            [
                'name' => 'Admin Spectare',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'balance' => 1000000,
            ]
        );

        // Membuat atau memperbarui User biasa
        User::updateOrCreate(
            ['email' => 'user@spectare.com'],
            [
                'name' => 'John Doe',
                'password' => Hash::make('password'),
                'role' => 'user',
                'balance' => 500000,
            ]
        );

        // Membuat 10 user biasa lainnya jika total user masih sedikit
        if (User::count() < 5) {
            User::factory(10)->create([
                'role' => 'user',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
