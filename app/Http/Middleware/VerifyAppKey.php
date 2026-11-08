<?php
// app/Http/Middleware/VerifyAppKey.php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyAppKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $validAppKey = config('mobile.app_key'); // يتم تعريفها في config/mobile.php وتُقرأ من .env
        
        if (! $request->hasHeader('X-App-Key') || $request->header('X-App-Key') !== $validAppKey) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized: Invalid or missing App Key',
            ], 401);
        }

        return $next($request);
    }
}