<?php
// app/Jobs/SendFirebaseNotificationJob.php

declare(strict_types=1);

namespace App\Jobs;

use App\Enums\AppNotificationStatus;
use App\Models\AppNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Illuminate\Support\Facades\Log;

class SendFirebaseNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public readonly AppNotification $notification
    ) {}

    public function handle(Messaging $messaging): void
    {
        // إذا كان الإشعار قد أُرسل بالفعل، لا تقم بإرساله مرة أخرى
        if ($this->notification->status === AppNotificationStatus::Completed) {
            return;
        }

        try {
            $message = CloudMessage::withTarget('topic', 'all_devices') // أو استخدام FCM Token محدد
                ->withNotification(Notification::create(
                    $this->notification->title,
                    $this->notification->body
                ))
                ->withData([
                    'notification_id' => (string) $this->notification->id,
                    'type' => $this->notification->type->value, // بناءً على AppNotificationType Enum
                ]);

            $messaging->send($message);

            // تحديث حالة الإشعار إلى مكتمل بنجاح
            $this->notification->update([
                'status' => AppNotificationStatus::Completed,
            ]);

        } catch (\Exception $e) {
            Log::error('Firebase Notification Failed', [
                'notification_id' => $this->notification->id,
                'error' => $e->getMessage(),
            ]);

            // تحديث حالة الإشعار إلى فاشل
            $this->notification->update([
                'status' => AppNotificationStatus::Failed, // افترضت أن لديك قيمة Failed في الـ Enum
            ]);
            
            // يمكن إعادة رمي الخطأ إذا كنت تريد لـ Queue أن يعيد المحاولة (Retry)
            // throw $e; 
        }
    }
}