<?php

// app/Filament/Resources/NotificationResource/Pages/ListNotifications.php

declare(strict_types=1);

namespace App\Filament\Resources\Notifications\Pages;

use App\Filament\Resources\Notifications\NotificationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

final class ListNotifications extends ListRecords
{
    protected static string $resource = NotificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
