<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Factory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Messaging::class, function ($app) {
            // قراءة المسار من المتغير البيئي، وتمريره إلى storage_path للحصول على المسار الكامل
            $credentialsPath = storage_path(env('FIREBASE_CREDENTIALS', 'app/private/firebase_credentials.json'));

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
