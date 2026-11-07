<?php
// app/Jobs/HolidayAlertJob.php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Holiday;
use App\Models\AppNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

final class HolidayAlertJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        $tomorrow = Carbon::tomorrow()->toDateString();

        // 1. Check if tomorrow is an active holiday
        $holiday = Holiday::query()
            ->where('date', $tomorrow)
            ->where('is_active', true)
            ->first();

        if (! $holiday) {
            return; // No holiday tomorrow, do nothing.
        }

        // 2. Create the notification record
        $notification = AppNotification::query()->create([
            'title'        => 'Holiday Alert 🎉',
            'body'         => "Tomorrow is a holiday for [{$holiday->name}]. Enjoy your time off!",
            'type'         => 'instant',
            'status'       => 'pending',
            'scheduled_at' => now(),
        ]);

        // 3. Dispatch the actual sending job
        SendFirebaseNotificationJob::dispatch($notification);
    }
}