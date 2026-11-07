<?php

// routes/api.php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\DeviceSyncController;
use App\Http\Controllers\Api\V1\InitConfigController;
use App\Http\Middleware\VerifyAppKey;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware(VerifyAppKey::class)->group(function () {
    Route::get('/init-config', InitConfigController::class);
    Route::post('/devices/sync', DeviceSyncController::class);
});
