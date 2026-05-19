<?php

namespace App\Http\Requests\Api\V1\Weather;

use App\Http\Requests\ApiFormRequest;

class Index extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
