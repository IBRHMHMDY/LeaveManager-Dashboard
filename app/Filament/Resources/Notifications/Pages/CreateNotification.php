<?php

// app/Filament/Resources/NotificationResource/Pages/CreateNotification.php

declare(strict_types=1);

namespace App\Filament\Resources\Notifications\Pages;

use App\Filament\Resources\NotificationResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateNotification extends CreateRecord
{
    protected static string $resource = NotificationResource::class;
}
