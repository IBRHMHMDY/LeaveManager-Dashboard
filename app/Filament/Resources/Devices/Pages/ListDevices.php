<?php

// app/Filament/Resources/DeviceResource/Pages/ListDevices.php

declare(strict_types=1);

namespace App\Filament\Resources\Devices\Pages;

use App\Filament\Resources\DeviceResource;
use Filament\Resources\Pages\ListRecords;

final class ListDevices extends ListRecords
{
    protected static string $resource = DeviceResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
