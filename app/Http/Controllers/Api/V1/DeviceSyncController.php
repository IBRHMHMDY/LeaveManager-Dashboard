<?php

// app/Http/Controllers/Api/V1/DeviceSyncController.php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Actions\Devices\SyncDeviceAction;
use App\Http\Requests\Api\V1\SyncDeviceRequest;
use App\Http\Resources\Api\V1\DeviceResource;
use Illuminate\Http\JsonResponse;

final class DeviceSyncController
{
    public function __construct(
        private readonly SyncDeviceAction $syncDeviceAction
    ) {}

    public function __invoke(SyncDeviceRequest $request): JsonResponse
    {
        $device = $this->syncDeviceAction->execute($request->toDto());

        return response()->json([
            'success' => true,
            'data' => new DeviceResource($device),
            'message' => 'Device synchronized successfully',
        ]);
    }
}
