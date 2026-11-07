<?php

// app/Filament/Resources/Holidays/Schemas/HolidayForm.php

declare(strict_types=1);

namespace App\Filament\Resources\HolidayResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;

final class HolidayForm
{
    public static function schema(): array
    {
        return [
            Section::make('Holiday Details')
                ->schema([
                    TextInput::make('name')
                        ->label('Holiday Name')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),

                    DatePicker::make('date')
                        ->label('Holiday Date')
                        ->required()
                        ->native(false) // Uses better UI picker
                        ->displayFormat('Y-m-d')
                        ->format('Y-m-d'),

                    Toggle::make('is_active')
                        ->label('Is Active')
                        ->helperText('If disabled, automated notifications will not be sent for this holiday.')
                        ->default(true)
                        ->inline(false),
                ])
                ->columns(2),
        ];
    }
}
