<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_supplier' => $this->faker->company, // Nama supplier
            'kontak' => $this->faker->phoneNumber, // Kontak supplier (nomor telepon)
            'alamat' => $this->faker->address, // Alamat supplier
        ];
    }
}
