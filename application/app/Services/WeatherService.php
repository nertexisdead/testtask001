<?php

namespace App\Services;

use App\Http\Requests\Api\V1\Weather\Index as IndexRequest;
use App\Http\Resources\SuccessResponseResource;
use App\Http\Resources\V1\Weather\Collection;
use App\Models\Weather;
use Illuminate\Http\JsonResponse;

class WeatherService
{
    public function index(IndexRequest $request): JsonResponse
    {
        $perPage = min((int) $request->get('perPage', 20), 100);
        $page = max((int) $request->get('page', 1), 1);

        $query = Weather::query();

        $total = $query->count();

        $items = $query
            ->orderByDesc('weather_time')
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        return response()->json(
            new SuccessResponseResource(
                new Collection(
                    $items,
                    [
                        'page' => $page,
                        'itemsCount' => $total,
                        'pages' => (int) ceil($total / $perPage),
                        'perPage' => $perPage,
                        'pageItemsCount' => $items->count(),
                        'next' => $page < ceil($total / $perPage) ? $page + 1 : null,
                        'prev' => $page > 1 ? $page - 1 : null,
                    ]
                )
            )
        );
    }
}
