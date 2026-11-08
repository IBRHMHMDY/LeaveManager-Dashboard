<?php

// app/Filament/Resources/DeviceResource/Tables/DeviceTable.php

declare(strict_types=1);

namespace App\Filament\Resources\Devices\Tables;

use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

final class DeviceTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('remote_id')
                    ->label('Device ID')
                    ->searchable()
                    ->copyable()
                    ->limit(20),

                TextColumn::make('os_type')
                    ->label('OS')
                    ->badge()
                    ->searchable(),

                TextColumn::make('app_version')
                    ->label('Version')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('last_active_at')
                    ->label('Last Active')
                    ->dateTime('d M Y, h:i A')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('os_type')
                    ->label('Operating System')
                    ->options([
                        'android' => 'Android',
                        'ios' => 'iOS',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->defaultSort('last_active_at', 'desc')
            ->deferLoading();
    }
}
