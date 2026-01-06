<?php

namespace Database\Factories;

use App\Models\PenggunaanPakan;
use App\Models\Pakan;
use App\Models\Kolam;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenggunaanPakanFactory extends Factory
{
    protected $model = PenggunaanPakan::class;

    public function definition(): array
    {
        return [
            'pakan_id' => Pakan::factory(),
            'kolam_id' => Kolam::factory(),
            'jumlah' => $this->faker->randomFloat(2, 1, 100),
            'tanggal' => $this->faker->dateTimeThisYear(),
            'user_id' => User::factory(),
        ];
    }
}
