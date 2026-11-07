<?php

// app/Filament/Resources/HolidayResource/Pages/CreateHoliday.php

declare(strict_types=1);

namespace App\Filament\Resources\HolidayResource\Pages;

use App\Filament\Resources\HolidayResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateHoliday extends CreateRecord
{
    protected static string $resource = HolidayResource::class;
}
