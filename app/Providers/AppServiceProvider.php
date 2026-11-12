<?php

namespace App\Providers;

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
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

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (
            app()->environment('production')
            || (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
        ) {
            URL::forceScheme('https');
        }

        // Auto-initialize Neon PostgreSQL tables and default admin accounts once per container
        $bootFlag = '/tmp/.neon_bootstrapped_v2';
        if (!app()->runningInConsole() && config('database.default') === 'pgsql' && !file_exists($bootFlag)) {
            if (!Schema::hasTable('articles') || !Schema::hasTable('uploaded_media')) {
                Artisan::call('migrate', ['--force' => true]);
            }

            if (Schema::hasTable('users') && User::where('email', 'admin@katar012.id')->doesntExist()) {
                Artisan::call('db:seed', [
                    '--class' => AdminUserSeeder::class,
                    '--force' => true,
                ]);
            }

            @file_put_contents($bootFlag, '1');
        }
    }
}
