<?php

// app/Http/Requests/Api/V1/InitConfigRequest.php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1;

use App\Enums\OsType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InitConfigRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'os_type' => ['required', 'string', Rule::enum(OsType::class)],
        ];
    }
}
