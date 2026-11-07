<?php

// app/Models/AppVersion.php

declare(strict_types=1);

namespace App\Models;

use App\Enums\OsType;
use Illuminate\Database\Eloquent\Model;

class AppVersion extends Model
{
    protected $fillable = [
        'platform',
        'latest_version',
        'min_required_version',
        'maintenance_mode',
        'release_notes',
    ];

    protected function casts(): array
    {
        return [
            'platform' => OsType::class,
            'maintenance_mode' => 'boolean',
        ];
    }
}
