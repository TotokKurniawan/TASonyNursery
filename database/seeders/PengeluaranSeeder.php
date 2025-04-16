<?php

namespace Database\Seeders;

use App\Models\pengeluaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        pengeluaran::factory()->count(10)->create();
    }
}
