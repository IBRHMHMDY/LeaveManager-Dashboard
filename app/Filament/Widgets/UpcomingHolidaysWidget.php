<?php
// app/Filament/Widgets/UpcomingHolidaysWidget.php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Holiday;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class UpcomingHolidaysWidget extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';
    
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Holiday::query()
                    ->where('start_date', '>=', now()->toDateString())
                    ->orderBy('start_date')
            )
            ->heading('Upcoming Holidays')
            ->description('Holidays scheduled for the future and their details.')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Holiday Name')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Start Date')
                    ->date('M d, Y')
                    ->sortable()
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('End Date')
                    ->date('M d, Y'),

                Tables\Columns\TextColumn::make('days_count')
                    ->label('Duration')
                    ->numeric()
                    ->suffix(' Days')
                    ->alignCenter(),
            ])
            ->paginated([5])
            ->deferLoading(); // تحسين الأداء عبر تأجيل التحميل
    }
}