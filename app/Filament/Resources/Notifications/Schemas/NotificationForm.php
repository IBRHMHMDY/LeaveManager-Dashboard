<?php

// app/Filament/Resources/Notifications/Schemas/NotificationForm.php

declare(strict_types=1);

namespace App\Filament\Resources\Notifications\Schemas;

use App\Enums\AppNotificationStatus;
use App\Enums\AppNotificationType;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;

final class NotificationForm
{
    public static function schema(): array
    {
        return [
            Section::make('Broadcast Message')
                ->schema([
                    TextInput::make('title')
                        ->label('Notification Title')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Textarea::make('body')
                        ->label('Notification Body')
                        ->required()
                        ->rows(3)
                        ->columnSpanFull(),

                    Select::make('type')
                        ->label('Send Type')
                        ->options([
                            // إضافة ->value لحل المشكلة
                            AppNotificationType::Immediate->value => 'Send Instantly',
                            AppNotificationType::Scheduled->value => 'Schedule for Later',
                            AppNotificationType::UpdateAlert->value => 'Update Alert',
                        ])
                        ->required()
                        ->live(),

                    Select::make('status')
                        ->label('Status')
                        ->options([
                            AppNotificationStatus::Pending->value => 'Pending',
                            AppNotificationStatus::Processing->value => 'Processing',
                            AppNotificationStatus::Completed->value => 'Completed',
                            AppNotificationStatus::Failed->value => 'Failed',
                        ])
                        ->default(AppNotificationStatus::Pending->value)
                        ->disabled()
                        ->dehydrated(false),

                    DateTimePicker::make('scheduled_at')
                        ->label('Schedule Date & Time')
                        ->required(fn (Get $get): bool => $get('type') === 'scheduled')
                        ->visible(fn (Get $get): bool => $get('type') === 'scheduled')
                        ->native(false),
                ])
                ->columns(2),
        ];
    }
}
