<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Kolam;

class KolamFactory extends Factory
{
    /**
     * Tentukan state default untuk model.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kolam' => $this->faker->word(), // Nama kolam acak
            'jenis_ikan' => $this->faker->randomElement(['Lele', 'Nila', 'Gurame']), // Jenis ikan acak
            'kapasitas' => $this->faker->numberBetween(100, 1000), // Kapasitas kolam acak
            'lokasi' => $this->faker->city(), // Lokasi acak
            'tanggal_dibuat' => $this->faker->dateTimeThisYear(), // Tanggal dibuat acak
        ];
    }
}
