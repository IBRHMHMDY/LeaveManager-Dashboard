<?php
// routes/console.php

declare(strict_types=1);

use App\Jobs\HolidayAlertJob;
use App\Jobs\WeeklyReminderJob;
use Illuminate\Support\Facades\Schedule;

// 1. Weekly Reminder Job: Every Thursday at 3:00 PM (15:00)
Schedule::job(new WeeklyReminderJob)
    ->weekly()
    ->thursdays()
    ->at('15:00')
    ->timezone('Africa/Cairo');

// 2. Holiday Alert Job: Daily at 8:00 AM
Schedule::job(new HolidayAlertJob)
    ->dailyAt('08:00')
    ->timezone('Africa/Cairo');

// 3. Optional: A command to clean up old devices or logs can go here.
// Schedule::command('model:prune')->daily();