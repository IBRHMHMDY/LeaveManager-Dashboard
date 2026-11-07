<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Factory;
use RuntimeException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Messaging::class, function (): Messaging {
            $credentialsPath = (string) config('services.firebase.credentials');

            if (! str_starts_with($credentialsPath, '/')) {
                $credentialsPath = base_path($credentialsPath);
            }

            if (! is_file($credentialsPath)) {
                throw new RuntimeException("Firebase credentials file not found at: {$credentialsPath}");
            }

            return (new Factory)
                ->withServiceAccount($credentialsPath)
                ->createMessaging();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
