<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Статистика посещений
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white border border-gray-200 rounded-lg p-5">
                    <div class="text-sm text-gray-500">Всего визитов</div>
                    <div class="mt-2 text-3xl font-semibold text-gray-900">{{ $totalVisits }}</div>
                </div>
                <div class="bg-white border border-gray-200 rounded-lg p-5">
                    <div class="text-sm text-gray-500">Уникальных посетителей</div>
                    <div class="mt-2 text-3xl font-semibold text-gray-900">{{ $uniqueVisitors }}</div>
                </div>
                <div class="bg-white border border-gray-200 rounded-lg p-5">
                    <div class="text-sm text-gray-500">API для счетчика</div>
                    <div class="mt-2 text-sm font-mono text-gray-900 break-all">{{ url('/api/v1/visits') }}</div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
                <section class="lg:col-span-3 bg-white border border-gray-200 rounded-lg p-5">
                    <h3 class="text-base font-semibold text-gray-900">Уникальные посещения по часам</h3>
                    <div id="hourly-visits-chart" class="mt-5 h-[520px] w-full"></div>
                </section>

                <section class="lg:col-span-2 bg-white border border-gray-200 rounded-lg p-5">
                    <h3 class="text-base font-semibold text-gray-900">Города</h3>
                    <div id="city-visits-chart" class="mt-5 h-[420px] w-full"></div>
                </section>
            </div>

            <section class="bg-white border border-gray-200 rounded-lg p-5">
                <h3 class="text-base font-semibold text-gray-900">Файлы для проверки</h3>
                <div class="mt-4 grid grid-cols-1 lg:grid-cols-2 gap-4 text-sm text-gray-700">
                    <div>
                        <div class="font-medium text-gray-900">Фильтрация полей</div>
                        <pre class="mt-2 overflow-x-auto rounded bg-gray-950 p-3 text-gray-100"><code>&lt;script src="{{ asset('js/type-fields-filter.js') }}"&gt;&lt;/script&gt;</code></pre>
                    </div>
                    <div>
                        <div class="font-medium text-gray-900">Счетчик посещений</div>
                        <pre class="mt-2 overflow-x-auto rounded bg-gray-950 p-3 text-gray-100"><code>&lt;script src="{{ asset('js/visitor-counter.js') }}"
        data-endpoint="{{ url('/api/v1/visits') }}"&gt;&lt;/script&gt;</code></pre>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.anychart.com/releases/8.12.1/css/anychart-ui.min.css">
    <script src="https://cdn.anychart.com/releases/8.12.1/js/anychart-base.min.js"></script>
    <script>
        anychart.onDocumentReady(function () {

            var hourlyData = @json($hourlyChartData);
            var cityData = @json($cityChartData);

            var hourlyChart = anychart.column(hourlyData);

            hourlyChart.title(false);
            hourlyChart.animation(true);
            hourlyChart.background().fill('transparent');
            hourlyChart.palette(['#2563eb']);

            hourlyChart.xAxis().title('Время');
            hourlyChart.yAxis().title('Уникальные посещения');

            hourlyChart.tooltip().format('Уникальных посещений: {%value}');
            hourlyChart.container('hourly-visits-chart');
            hourlyChart.draw();

            var cityChart = anychart.pie(
                cityData.length ? cityData : [{x: 'Нет данных', value: 1}]
            );

            cityChart.title(false);
            cityChart.animation(true);
            cityChart.background().fill('transparent');
            cityChart.innerRadius('35%');

            cityChart.labels().position('outside');

            cityChart.legend()
                .enabled(true)
                .position('bottom')
                .itemsLayout('vertical');

            cityChart.tooltip().format('Уникальных посетителей: {%value}');
            cityChart.container('city-visits-chart');
            cityChart.draw();
        });
    </script>
</x-app-layout>
