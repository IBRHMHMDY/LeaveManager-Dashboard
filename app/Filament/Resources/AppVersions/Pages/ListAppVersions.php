<?php

declare(strict_types=1);

namespace App\Filament\Resources\AppVersions\Pages;

use App\Filament\Resources\DeviceResource;
use Filament\Resources\Pages\ListRecords;

final class ListAppVersions extends ListRecords
{
    protected static string $resource = DeviceResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
