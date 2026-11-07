<?php

// app/Filament/Resources/NotificationResource/Pages/EditNotification.php

declare(strict_types=1);

namespace App\Filament\Resources\Notifications\Pages;

use App\Filament\Resources\NotificationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

final class EditNotification extends EditRecord
{
    protected static string $resource = NotificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
