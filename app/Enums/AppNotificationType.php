<?php

// app/Enums/AppNotificationType.php

declare(strict_types=1);

namespace App\Enums;

enum AppNotificationType: string
{
    case Immediate = 'immediate';
    case Scheduled = 'scheduled';
    case UpdateAlert = 'update_alert';
}
