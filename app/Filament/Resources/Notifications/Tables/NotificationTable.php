<?php

// app/Filament/Resources/Notifications/Tables/NotificationTable.php

declare(strict_types=1);

namespace App\Filament\Resources\Notifications\Tables;

use App\Enums\AppNotificationStatus;
use App\Enums\AppNotificationType;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class NotificationTable
{
    public static function configure(Table $table): Table
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
                    ->color(fn (AppNotificationType $state): string => match ($state) {
                        AppNotificationType::Immediate => 'success',
                        AppNotificationType::Scheduled => 'warning',
                        AppNotificationType::UpdateAlert => 'info',
                    }),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (AppNotificationStatus $state): string => match ($state) {
                        AppNotificationStatus::Pending => 'gray',
                        AppNotificationStatus::Processing => 'info',
                        AppNotificationStatus::Completed => 'success',
                        AppNotificationStatus::Failed => 'danger',
                    }),

                TextColumn::make('scheduled_at')
                    ->label('Scheduled For')
                    ->dateTime('d M Y, h:i A')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                ViewAction::make(),
                EditAction::make()
                    ->visible(fn ($record) => $record->status === AppNotificationStatus::Pending->value),
            ]);
    }
}
