<?php

declare(strict_types=1);

namespace App\Filament\Resources\HolidayResource\Pages;

use App\Filament\Resources\AppVersionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditAppVersion extends EditRecord
{
    protected static string $resource = AppVersionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
