<?php

// app/Filament/Resources/HolidayResource/Pages/EditHoliday.php

declare(strict_types=1);

namespace App\Filament\Resources\Holidays\Pages;

use App\Filament\Resources\Holidays\HolidaysResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

final class EditHoliday extends EditRecord
{
    protected static string $resource = HolidaysResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
