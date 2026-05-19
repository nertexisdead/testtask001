<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\VisitorVisit;
use Carbon\CarbonPeriod;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(): View
    {
        return view('index', [
            //
        ]);
    }

    public function dashboard(): View
    {
        $from = now()->subHours(23)->startOfHour();

        $visits = VisitorVisit::query()
            ->where('visited_at', '>=', $from)
            ->get();

        $hourlyVisits = collect(CarbonPeriod::create($from, '1 hour', now()->startOfHour()))
            ->map(function ($hour) use ($visits) {
                $visitsInHour = $visits->filter(
                    fn (VisitorVisit $visit) => $visit->visited_at->isSameHour($hour)
                );

                return [
                    'time' => $hour->format('H:00'),
                    'count' => $visitsInHour->pluck('visitor_key')->unique()->count(),
                ];
            });

        $cityStats = VisitorVisit::query()
            ->selectRaw("COALESCE(NULLIF(city, ''), 'Unknown') as city, COUNT(DISTINCT visitor_key) as count")
            ->groupBy('city')
            ->orderByDesc('count')
            ->get();

        $totalVisits = VisitorVisit::query()->count();
        $uniqueVisitors = VisitorVisit::query()->distinct('visitor_key')->count('visitor_key');

        return view('dashboard', [
            'hourlyChartData' => $hourlyVisits->map(fn ($item) => [
                'x' => $item['time'],
                'value' => $item['count'],
            ])->values(),

            'cityChartData' => $cityStats->map(fn ($item) => [
                'x' => $item->city,
                'value' => (int) $item->count,
            ])->values(),

            'totalVisits' => $totalVisits,
            'uniqueVisitors' => $uniqueVisitors,
        ]);
    }
}
