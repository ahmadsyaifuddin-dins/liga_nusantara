<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    @php
        $cards = [
            [
                'title' => 'Total Pertandingan',
                'value' => $totalMatches,
                'gradient' => 'from-blue-500 to-blue-600',
                'text' => 'text-blue-100',
                'icon' => '<path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
            ],
            [
                'title' => 'Kemenangan',
                'value' => $wins,
                'gradient' => 'from-green-500 to-green-600',
                'text' => 'text-green-100',
                'icon' => '<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>',
            ],
            [
                'title' => 'Total Gol',
                'value' => $totalGoals,
                'gradient' => 'from-purple-500 to-purple-600',
                'text' => 'text-purple-100',
                'icon' => '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>',
            ],
            [
                'title' => 'Win Rate',
                'value' => number_format($winRate, 1) . '%',
                'gradient' => 'from-orange-500 to-orange-600',
                'text' => 'text-orange-100',
                'icon' => '<path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>',
            ],
        ];
    @endphp

    @foreach ($cards as $card)
        <div class="bg-gradient-to-r {{ $card['gradient'] }} rounded-xl p-6 text-white shadow-lg transform hover:scale-105 transition-transform duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="{{ $card['text'] }} text-sm font-medium">{{ $card['title'] }}</p>
                    <p class="text-3xl font-bold">{{ $card['value'] }}</p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        {!! $card['icon'] !!}
                    </svg>
                </div>
            </div>
        </div>
    @endforeach
</div>
