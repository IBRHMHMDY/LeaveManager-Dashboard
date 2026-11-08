<?php

// app/Filament/Resources/DeviceResource/Pages/ViewDevice.php

declare(strict_types=1);

namespace App\Filament\Resources\Devices\Pages;

use App\Filament\Resources\Devices\DeviceResource;
use Filament\Resources\Pages\ViewRecord;

final class ViewDevice extends ViewRecord
{
    protected static string $resource = DeviceResource::class;
}
