<?php

// app/Filament/Resources/AppVersionResource/Tables/AppVersionTable.php

declare(strict_types=1);

namespace App\Filament\Resources\AppVersions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class AppVersionTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('platform')
                    ->label('Platform')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'android' => 'success',
                        'ios' => 'info',
                        default => 'gray',
                    }),

                TextColumn::make('latest_version')
                    ->label('Latest'),

                TextColumn::make('min_required_version')
                    ->label('Min Required'),

                IconColumn::make('maintenance_mode')
                    ->label('Maintenance')
                    ->boolean(),
            ])
            ->actionsRecord([
                EditAction::make(),
            ])
            ->bulkActionsRecord([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->paginated(false); // Usually only 2 records (Android/iOS)
    }
}
