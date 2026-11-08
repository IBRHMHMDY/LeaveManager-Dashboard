<?php
// app/Filament/Resources/Holidays/Schemas/HolidayForm.php

declare(strict_types=1);

namespace App\Filament\Resources\Holidays\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;


final class HolidayForm
{
    public static function schema(): array
    {
        return [
            TextInput::make('name')
                ->label('Holiday Name')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),

            DatePicker::make('start_date')
                ->label('Start Date')
                ->required()
                ->live()
                ->afterStateUpdated(function (Set $set, $state) {
                    if ($state) {
                        $set('end_date', $state);
                    }
                }),

            DatePicker::make('end_date')
                ->label('End Date')
                ->required()
                ->minDate(fn (Get $get) => $get('start_date')),
        ];
    }
}