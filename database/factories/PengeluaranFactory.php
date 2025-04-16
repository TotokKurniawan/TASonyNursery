<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pengeluaran;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengeluaran>
 */
class PengeluaranFactory extends Factory
{
    protected $model = Pengeluaran::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'tanggal' => $this->faker->date(),
            'jumlah' => $this->faker->randomFloat(2, 1000, 1000000), // Nilai antara 1.000 dan 1.000.000
            'keterangan' => $this->faker->sentence(), // Kalimat acak sebagai keterangan
        ];
    }
}
