<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Visit\Store as StoreRequest;
use App\Services\VisitService;
use Illuminate\Http\JsonResponse;

class VisitController extends Controller
{
    public function __construct(
        protected VisitService $visitService
    ) {
    }

    public function store(StoreRequest $request): JsonResponse
    {
        return $this->visitService->store($request);
    }

    public function options(): JsonResponse
    {
        return $this->visitService->options();
    }
}
