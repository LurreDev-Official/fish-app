<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pakan;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pakan>
 */
class PakanFactory extends Factory
{
    /**
     * Mendefinisikan state default model
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_pakan' => $this->faker->word(), // Menghasilkan nama pakan acak
            'kategori' => $this->faker->randomElement(['pelet', 'alami']), // Pilih kategori pakan (pelet/alami)
            'satuan' => $this->faker->randomElement(['kg', 'liter']), // Pilih satuan (kg/liter)
            'harga_per_kg' => $this->faker->randomFloat(2, 10000, 100000), // Harga per kg (acak antara 10.000 dan 100.000)
        ];
    }
}
