<?php

namespace Database\Seeders;

use App\Models\pelanggan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelanggannSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        pelanggan::factory()->count(10)->create();
    }
}
