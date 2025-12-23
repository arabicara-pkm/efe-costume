<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // 2. Tambahkan logika ini:
        // Jika aplikasi berjalan di Production (Railway), paksa gunakan HTTPS
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
