<?php
// app/Jobs/SendFirebaseNotificationJob.php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Device;
use App\Models\AppNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;
use Throwable;

final class SendFirebaseNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $timeout = 120; // 2 minutes max for large broadcasts

    public function __construct(
        public readonly AppNotification $notification
    ) {}

    public function handle(Messaging $messaging): void
    {
        try {
            // Fetch devices that have a valid FCM token.
            // FCM allows a maximum of 500 tokens per multicast message.
            Device::query()
                ->whereNotNull('fcm_token')
                ->where('fcm_token', '!=', '')
                ->chunk(500, function ($devices) use ($messaging) {
                    $tokens = $devices->pluck('fcm_token')->toArray();

                    if (empty($tokens)) {
                        return;
                    }

                    $message = CloudMessage::new()
                        ->withNotification(FirebaseNotification::create(
                            $this->notification->title,
                            $this->notification->body
                        ))
                        ->withData([
                            'notification_id' => (string) $this->notification->id,
                            'type'            => $this->notification->type,
                            'click_action'    => 'FLUTTER_NOTIFICATION_CLICK',
                        ]);

                    $report = $messaging->sendMulticast($message, $tokens);

                    // Optional: Log failures to clean up invalid tokens later
                    if ($report->hasFailures()) {
                        Log::warning('Firebase notification partial failure', [
                            'notification_id' => $this->notification->id,
                            'failed_count'    => $report->failures()->count(),
                        ]);
                    }
                });

            // Mark as sent
            $this->notification->update(['status' => 'sent']);
            
        } catch (Throwable $e) {
            $this->notification->update(['status' => 'failed']);
            
            Log::error('Firebase broadcast completely failed', [
                'notification_id' => $this->notification->id,
                'error'           => $e->getMessage(),
            ]);

            throw $e; // Rethrow to allow Laravel Horizon/Queue to retry
        }
    }
}