<?php

// app/Http/Resources/Api/V1/DeviceResource.php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeviceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'remote_id' => $this->remote_id,
            'os_type' => $this->os_type->value,
            'app_version' => $this->app_version,
            'is_active' => true,
        ];
    }
}
