<?php

// app/Actions/Devices/SyncDeviceAction.php

declare(strict_types=1);

namespace App\Actions\Devices;

use App\Data\SyncDeviceData;
use App\Models\Device;
use Illuminate\Support\Facades\DB;
use Throwable;

final readonly class SyncDeviceAction
{
    /**
     * @throws Throwable
     */
    public function execute(SyncDeviceData $data): Device
    {
        return DB::transaction(function () use ($data): Device {
            // updateOrCreate تقوم بالبحث عبر remote_id، وإن لم تجده تنشئه، وإن وجدته تقوم بتحديث الباقي
            return Device::query()->updateOrCreate(
                ['remote_id' => $data->remoteId],
                [
                    'os_type' => $data->osType,
                    'fcm_token' => $data->fcmToken,
                    'app_version' => $data->appVersion,
                    'last_active_at' => now(),
                ]
            );
        });
    }
}
