<?php

namespace App\Http\Requests\Api\V1\Visit;

use App\Http\Requests\ApiFormRequest;

class Store extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'visitor_key' => ['nullable', 'string', 'max:64'],
            'ip' => ['nullable', 'string', 'max:45'],
            'city' => ['nullable', 'string', 'max:255'],
            'device' => ['nullable', 'string', 'max:255'],
            'user_agent' => ['nullable', 'string', 'max:2000'],
            'page_url' => ['nullable', 'string', 'max:2000'],
        ];
    }
}
