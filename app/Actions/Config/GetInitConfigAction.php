<?php

// app/Actions/Config/GetInitConfigAction.php

declare(strict_types=1);

namespace App\Actions\Config;

use App\Enums\OsType;
use App\Models\AppVersion;

final readonly class GetInitConfigAction
{
    public function execute(OsType $osType): ?AppVersion
    {
        // نجلب إعدادات المنصة المحددة (أندرويد أو iOS)
        return AppVersion::query()->where('platform', $osType->value)->first();
    }
}
