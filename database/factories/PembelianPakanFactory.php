<?php

namespace Database\Factories;

use App\Models\PembelianPakan;
use App\Models\Pakan;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PembelianPakanFactory extends Factory
{
    protected $model = PembelianPakan::class;

    public function definition(): array
    {
        return [
            'pakan_id' => Pakan::factory(),
            'supplier_id' => Supplier::factory(),
            'jumlah' => $this->faker->numberBetween(1, 100),
            'harga_satuan' => $this->faker->randomFloat(2, 10000, 50000),
            'total_harga' => function (array $attributes) {
                return $attributes['jumlah'] * $attributes['harga_satuan'];
            },
            'tanggal_pembelian' => $this->faker->dateTimeThisYear(),
            'user_id' => User::factory(),
        ];
    }
}
