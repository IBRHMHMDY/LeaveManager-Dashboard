<?php

// app/Http/Resources/Api/V1/InitConfigResource.php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InitConfigResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // في حالة عدم وجود إعدادات للمنصة بعد في قاعدة البيانات، نرسل قيماً افتراضية آمنة
        if (is_null($this->resource)) {
            return [
                'latest_version' => '1.0.0',
                'min_required_version' => '1.0.0',
                'maintenance_mode' => false,
                'release_notes' => null,
            ];
        }

        return [
            'latest_version' => $this->latest_version,
            'min_required_version' => $this->min_required_version,
            'maintenance_mode' => $this->maintenance_mode,
            'release_notes' => $this->release_notes,
        ];
    }
}
