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
        $expectedKey = config('mobile.app_key');
        $providedKey = $request->header('X-App-Key');

        if (empty($expectedKey) || $providedKey !== $expectedKey) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid or missing App Key.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
