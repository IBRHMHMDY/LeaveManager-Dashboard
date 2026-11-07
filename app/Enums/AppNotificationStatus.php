<?php

// app/Enums/AppNotificationStatus.php

declare(strict_types=1);

namespace App\Enums;

enum AppNotificationStatus: string
{
    case Pending = 'pending';
    case Processing = 'processing';
    case Completed = 'completed';
    case Failed = 'failed';
}
