<?php

// app/Http/Controllers/Api/V1/InitConfigController.php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Actions\Config\GetInitConfigAction;
use App\Enums\OsType;
use App\Http\Requests\Api\V1\InitConfigRequest;
use App\Http\Resources\Api\V1\InitConfigResource;
use Illuminate\Http\JsonResponse;

final class InitConfigController
{
    public function __construct(
        private readonly GetInitConfigAction $getInitConfigAction
    ) {}

    public function __invoke(InitConfigRequest $request): JsonResponse
    {
        $osType = OsType::from($request->validated('os_type'));

        $config = $this->getInitConfigAction->execute($osType);

        return response()->json([
            'success' => true,
            'data' => new InitConfigResource($config),
        ]);
    }
}
