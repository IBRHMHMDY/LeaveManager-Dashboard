<?php

// app/Models/Device.php

declare(strict_types=1);

namespace App\Models;

use App\Enums\OsType;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'remote_id',
        'fcm_token',
        'os_type',
        'app_version',
        'last_active_at',
    ];

    protected function casts(): array
    {
        return [
            'os_type' => OsType::class,
            'last_active_at' => 'datetime',
        ];
    }
}
