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
        // Membuat atau memperbarui Akun Admin Utama
        User::updateOrCreate(
            ['email' => 'admin@spectare.com'],
            [
                'name' => 'Admin Spectare',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'balance' => 1000000, // Rp 1.000.000
            ]
        );

        // Membuat atau memperbarui Akun User Uji Coba
        User::updateOrCreate(
            ['email' => 'user@spectare.com'],
            [
                'name' => 'John Doe',
                'password' => Hash::make('password'),
                'role' => 'user',
                'balance' => 500000, // Rp 500.000
            ]
        );

        // Menambahkan 10 user random jika data masih sedikit
        if (User::count() < 5) {
            User::factory(10)->create([
                'role' => 'user',
                'password' => Hash::make('password'),
                'balance' => 0,
            ]);
        }
    }
}
