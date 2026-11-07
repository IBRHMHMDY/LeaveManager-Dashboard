<?php

// app/Enums/OsType.php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum OsType: string implements HasColor, HasLabel
{
    case Android = 'android';
    case Ios = 'ios';

    public function getLabel(): string
    {
        return match ($this) {
            self::Android => 'Android',
            self::Ios => 'iOS',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Android => 'success',
            self::Ios => 'info',
        };
    }
}
