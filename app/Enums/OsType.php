<?php

// app/Enums/OsType.php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum OsType: string implements HasColor, HasIcon, HasLabel
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

    public function getColor(): string
    {
        return match ($this) {
            self::Android => 'success',
            self::Ios => 'info',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Android => 'heroicon-o-device-phone-mobile',
            self::Ios => 'heroicon-o-device-tablet',
        };
    }
}
