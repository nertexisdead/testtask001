<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\ApiDefaultException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Weather\Index as IndexRequest;
use App\Services\WeatherService;
use Illuminate\Http\JsonResponse;

class WeatherController extends Controller
{
    public function __construct(
        protected WeatherService $weatherService
    ) {
    }

    public function index(IndexRequest $request): ApiDefaultException|JsonResponse
    {
        return $this->weatherService->index($request);
    }
}
