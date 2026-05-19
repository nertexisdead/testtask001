<?php

namespace App\Services;

use App\Http\Requests\Api\V1\Visit\Store as StoreRequest;
use App\Models\VisitorVisit;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class VisitService
{
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $visit = VisitorVisit::create([
            'visitor_key' => $data['visitor_key'] ?? hash('sha256', $request->ip() . '|' . $request->userAgent()),
            'ip' => $data['ip'] ?? $request->ip(),
            'city' => $data['city'] ?? null,
            'device' => $data['device'] ?? 'unknown',
            'user_agent' => Str::limit($data['user_agent'] ?? $request->userAgent(), 2000, ''),
            'page_url' => $data['page_url'] ?? null,
            'visited_at' => now(),
        ]);

        return response()
            ->json([
                'success' => true,
                'id' => $visit->id,
            ], 201)
            ->withHeaders($this->corsHeaders());
    }

    public function options(): JsonResponse
    {
        return response()
            ->json(null, 204)
            ->withHeaders($this->corsHeaders());
    }

    private function corsHeaders(): array
    {
        return [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'POST, OPTIONS',
            'Access-Control-Allow-Headers' => 'Content-Type, Accept',
        ];
    }
}
