<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentView;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        FilamentView::registerRenderHook(
            'panels::head.start',
            fn (): string => '<meta name="robots" content="noindex,nofollow">'
        );
        // Enable foreign key support for SQLite
        if (env('DB_CONNECTION') === 'sqlite') {
            DB::statement('PRAGMA foreign_keys=1');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
