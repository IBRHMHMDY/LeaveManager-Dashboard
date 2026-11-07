<?php

// app/Http/Requests/Api/V1/SyncDeviceRequest.php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1;

use App\Data\SyncDeviceData;
use App\Enums\OsType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SyncDeviceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'remote_id' => ['required', 'string', 'max:255'],
            'os_type' => ['required', 'string', Rule::enum(OsType::class)],
            'fcm_token' => ['nullable', 'string'],
            'app_version' => ['nullable', 'string', 'max:20'],
        ];
    }

    public function toDto(): SyncDeviceData
    {
        return new SyncDeviceData(
            remoteId: $this->validated('remote_id'),
            osType: OsType::from($this->validated('os_type')),
            fcmToken: $this->validated('fcm_token'),
            appVersion: $this->validated('app_version'),
        );
    }
}
