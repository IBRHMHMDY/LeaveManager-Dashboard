<?php

// app/Filament/Resources/NotificationResource/Schemas/NotificationForm.php

declare(strict_types=1);

namespace App\Filament\Resources\NotificationResource\Schemas;

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
                            'instant' => 'Send Instantly',
                            'scheduled' => 'Schedule for Later',
                            'update' => 'App Update Alert',
                        ])
                        ->required()
                        ->live(), // To toggle scheduled_at visibility

                    Select::make('status')
                        ->label('Status')
                        ->options([
                            'pending' => 'Pending',
                            'sent' => 'Sent',
                            'failed' => 'Failed',
                        ])
                        ->default('pending')
                        ->disabled()
                        ->dehydrated(false), // Handled by background jobs

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
