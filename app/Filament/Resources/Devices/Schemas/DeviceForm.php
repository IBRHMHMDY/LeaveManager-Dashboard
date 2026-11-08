<?php

// app/Filament/Resources/DeviceResource/Schemas/DeviceForm.php

declare(strict_types=1);

namespace App\Filament\Resources\Devices\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

final class DeviceForm
{
    public static function schema(): array
    {
        return [
            Section::make('Device Information')
                ->schema([
                    TextInput::make('remote_id')
                        ->label('Device Unique ID')
                        ->maxLength(255),

                    TextInput::make('fcm_token')
                        ->label('FCM Token')
                        ->columnSpanFull(),

                    TextInput::make('os_type')
                        ->label('Operating System')
                        ->maxLength(50),

                    TextInput::make('app_version')
                        ->label('App Version')
                        ->maxLength(50),

                    DateTimePicker::make('last_active_at')
                        ->label('Last Active'),
                ])
                ->columns(2),
        ];
    }
}
