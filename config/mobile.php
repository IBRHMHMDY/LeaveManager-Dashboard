<?php

// config/mobile.php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Mobile App Security Key
    |--------------------------------------------------------------------------
    |
    | This key is used to authenticate requests coming from the Flutter app.
    | It should be a long, random string. Ensure you set this in your .env file.
    |
    */
    'app_key' => env('MOBILE_APP_KEY', 'your-fallback-secret-key-for-local-dev'),
];
