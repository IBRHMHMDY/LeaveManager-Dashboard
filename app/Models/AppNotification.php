<?php

// app/Models/AppNotification.php

declare(strict_types=1);

namespace App\Models;

use App\Enums\AppNotificationStatus;
use App\Enums\AppNotificationType;
use Illuminate\Database\Eloquent\Model;

class AppNotification extends Model
{
    protected $fillable = [
        'title',
        'body',
        'type',
        'status',
        'scheduled_at',
    ];

    protected function casts(): array
    {
        return [
            'type' => AppNotificationType::class,
            'status' => AppNotificationStatus::class,
            'scheduled_at' => 'datetime',
        ];
    }
}
