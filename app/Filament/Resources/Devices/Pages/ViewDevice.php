<?php

// app/Filament/Resources/DeviceResource/Pages/ViewDevice.php

declare(strict_types=1);

namespace App\Filament\Resources\DeviceResource\Pages;

use App\Filament\Resources\DeviceResource;
use Filament\Resources\Pages\ViewRecord;

final class ViewDevice extends ViewRecord
{
    protected static string $resource = DeviceResource::class;
}
