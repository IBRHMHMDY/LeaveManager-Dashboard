<?php

declare(strict_types=1);

namespace App\Filament\Resources\AppVersions\AppVersionResource;

use App\Filament\Resources\AppVersionResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateAppVersion extends CreateRecord
{
    protected static string $resource = AppVersionResource::class;
}
