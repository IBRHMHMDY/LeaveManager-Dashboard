<?php

// app/Filament/Resources/HolidayResource/Pages/ListHolidays.php

declare(strict_types=1);

namespace App\Filament\Resources\Holidays\Pages;

use App\Filament\Resources\Holidays\HolidaysResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

final class ListHolidays extends ListRecords
{
    protected static string $resource = HolidaysResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
