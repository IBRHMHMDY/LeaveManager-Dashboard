<?php

// app/Filament/Resources/NotificationResource/Tables/NotificationTable.php

declare(strict_types=1);

namespace App\Filament\Resources\NotificationResource\Tables;

use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class NotificationTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->limit(30),

                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'instant' => 'success',
                        'scheduled' => 'warning',
                        'update' => 'info',
                        default => 'gray',
                    }),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'sent' => 'success',
                        'failed' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('scheduled_at')
                    ->label('Scheduled For')
                    ->dateTime('d M Y, h:i A')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actionsRecord([
                ViewAction::make(),
                EditAction::make()
                    // Only allow editing if not sent yet
                    ->visible(fn ($record) => $record->status === 'pending'),
            ]);
    }
}
