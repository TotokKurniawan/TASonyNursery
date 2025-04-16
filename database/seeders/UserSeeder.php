<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat satu pengguna dengan role 'admin'
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('adminpassword'), // Anda bisa mengganti dengan password yang diinginkan
            'role' => 'admin',
        ]);

        // Buat beberapa pengguna dengan role 'user'
        User::factory(10)->create(); // Membuat 10 pengguna dengan role 'user'
    }
}
