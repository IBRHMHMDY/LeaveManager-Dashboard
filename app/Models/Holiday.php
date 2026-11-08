<?php

// app/Models/Holiday.php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'days_count',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'days_count' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        // حساب عدد الأيام تلقائياً قبل الحفظ في قاعدة البيانات
        static::saving(function (Holiday $holiday) {
            if ($holiday->start_date && $holiday->end_date) {
                // نضيف 1 لاحتساب يوم البداية ضمن الإجازة (مثال: نفس اليوم = يوم واحد)
                $holiday->days_count = $holiday->start_date->diffInDays($holiday->end_date) + 1;
            }
        });
    }
}
