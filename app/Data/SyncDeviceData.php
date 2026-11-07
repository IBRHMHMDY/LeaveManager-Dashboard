<?php

// app/Data/SyncDeviceData.php

declare(strict_types=1);

namespace App\Data;

use App\Enums\OsType;

final readonly class SyncDeviceData
{
    public function __construct(
        public string $remoteId,
        public OsType $osType,
        public ?string $fcmToken,
        public ?string $appVersion,
    ) {}
}
