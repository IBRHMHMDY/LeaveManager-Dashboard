<?php
// app/Jobs/WeeklyReminderJob.php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\AppNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class WeeklyReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        // 1. Create the notification record
        $notification = AppNotification::query()->create([
            'title'        => 'Weekly Reminder',
            'body'         => 'Don\'t forget to log your leave balances and update your data for this week.',
            'type'         => 'instant',
            'status'       => 'pending',
            'scheduled_at' => now(),
        ]);

        // 2. Dispatch the actual sending job
        SendFirebaseNotificationJob::dispatch($notification);
    }
}