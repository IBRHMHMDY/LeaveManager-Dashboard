<?php

// app/Filament/Resources/AppVersions/Schemas/AppVersionForm.php

declare(strict_types=1);

namespace App\Filament\Resources\AppVersions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;

final class AppVersionForm
{
    public static function schema(): array
    {
        return [
            Section::make('Version Control Settings')
                ->schema([
                    Select::make('platform')
                        ->label('Platform')
                        ->options([
                            'android' => 'Android',
                            'ios' => 'iOS',
                        ])
                        ->required()
                        ->unique(ignoreRecord: true), // Usually one active record per platform

                    TextInput::make('latest_version')
                        ->label('Latest Version')
                        ->placeholder('e.g., 1.0.5')
                        ->required()
                        ->maxLength(50),

                    TextInput::make('min_required_version')
                        ->label('Minimum Required Version')
                        ->helperText('Users below this version will be forced to update.')
                        ->placeholder('e.g., 1.0.2')
                        ->required()
                        ->maxLength(50),

                    Toggle::make('maintenance_mode')
                        ->label('Maintenance Mode')
                        ->helperText('If enabled, the app will show a maintenance screen on startup.')
                        ->default(false)
                        ->inline(false),

                    Textarea::make('release_notes')
                        ->label('Release Notes')
                        ->rows(4)
                        ->columnSpanFull(),
                ])
                ->columns(2),
        ];
    }
}
