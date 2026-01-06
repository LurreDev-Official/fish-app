<?php

namespace Database\Seeders;

use App\Models\Kolam;
use App\Models\Pakan;
use App\Models\PembelianPakan;
use App\Models\Post;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.test',
            'password' => Hash::make('admin@admin.test'),
        ]);

        Kolam::factory()
            ->count(5)
            ->create();
        Pakan::factory()
            ->count(2)
            ->create();
        PembelianPakan::factory()->count(1)->create();
        // \App\Models\PenggunaanPakan::factory()->count(1)->create();
        Post::factory()
            ->count(1)
            ->create();

        Notification::make()
            ->title('Welcome to Filament')
            ->body('You are ready to start building your application.')
            ->success()
            ->sendToDatabase($user);
    }
}
