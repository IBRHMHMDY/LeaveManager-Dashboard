<?php
// app/Filament/Widgets/DashboardStatsWidget.php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enums\AppNotificationStatus;
use App\Models\AppNotification;
use App\Models\Device;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Devices', Device::count())
                ->description('Registered devices across all platforms')
                ->descriptionIcon('heroicon-m-device-phone-mobile')
                ->color('primary'),

            // افترضنا هنا وجود حالات الإشعار في الـ Enum، يرجى مطابقتها مع ما لديك
            Stat::make('Successful Notifications', AppNotification::where('status', AppNotificationStatus::Completed)->count())
                ->description('Delivered successfully')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Failed Notifications', AppNotification::where('status', AppNotificationStatus::Failed)->count())
                ->description('Failed deliveries')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
        ];
        }
    }