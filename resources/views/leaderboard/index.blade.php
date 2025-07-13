<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="bg-gradient-to-r from-yellow-500 to-orange-600 p-2 rounded-lg">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                Klasemen Pemain PES
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium">Total Pemain</p>
                            <p class="text-3xl font-bold">{{ count($players) }}</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-2xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-medium">Top Player</p>
                            <p class="text-xl font-bold">{{ $players->first()->name ?? 'Belum ada' }}</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm font-medium">Total Tropi</p>
                            <p class="text-3xl font-bold">{{ $players->sum('wins') }}</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Desktop View -->
            <div class="hidden md:block">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-2xl">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Peringkat Pemain</h3>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                Diurutkan berdasarkan jumlah kemenangan
                            </div>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Peringkat</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Pemain</th>
                                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">🏆 Tropi</th>
                                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Final</th>
                                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Skor Rata-rata</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($players as $index => $player)
                                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                @if($index == 0)
                                                    <div class="flex items-center justify-center w-10 h-10 bg-gradient-to-r from-yellow-400 to-yellow-600 text-white rounded-full text-lg font-bold shadow-lg">
                                                        👑
                                                    </div>
                                                @elseif($index == 1)
                                                    <div class="flex items-center justify-center w-10 h-10 bg-gradient-to-r from-gray-400 to-gray-600 text-white rounded-full text-sm font-bold shadow-lg">
                                                        🥈
                                                    </div>
                                                @elseif($index == 2)
                                                    <div class="flex items-center justify-center w-10 h-10 bg-gradient-to-r from-orange-400 to-orange-600 text-white rounded-full text-sm font-bold shadow-lg">
                                                        🥉
                                                    </div>
                                                @else
                                                    <div class="flex items-center justify-center w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-full text-sm font-bold">
                                                        {{ $index + 1 }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center mr-4">
                                                    <span class="text-white font-bold text-lg">{{ substr($player->name, 0, 1) }}</span>
                                                </div>
                                                <div>
                                                    <a href="{{ route('players.profile', $player->id) }}" class="text-lg font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors duration-200">
                                                        {{ $player->name }}
                                                    </a>
                                                    @if($index == 0)
                                                        <p class="text-sm text-yellow-600 dark:text-yellow-400 font-medium">Current Champion</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex items-center justify-center">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100">
                                                    🏆 {{ $player->wins }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                                {{ $player->matches }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="text-lg font-bold text-gray-900 dark:text-white">
                                                {{ number_format($player->avg_score, 2) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                                </svg>
                                                <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">Belum ada data klasemen</p>
                                                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Mulai bermain untuk melihat peringkat</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Mobile View -->
            <div class="md:hidden">
                <div class="space-y-4">
                    @forelse($players as $index => $player)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
                            <!-- Ranking Header -->
                            <div class="
                                @if($index == 0) bg-gradient-to-r from-yellow-500 to-orange-600
                                @elseif($index == 1) bg-gradient-to-r from-gray-400 to-gray-600
                                @elseif($index == 2) bg-gradient-to-r from-orange-400 to-orange-600
                                @else bg-gradient-to-r from-blue-500 to-purple-600
                                @endif
                                px-4 py-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="bg-white bg-opacity-20 rounded-full p-2">
                                            @if($index == 0)
                                                <span class="text-white text-xl">👑</span>
                                            @elseif($index == 1)
                                                <span class="text-white text-xl">🥈</span>
                                            @elseif($index == 2)
                                                <span class="text-white text-xl">🥉</span>
                                            @else
                                                <span class="text-white font-bold text-lg">{{ $index + 1 }}</span>
                                            @endif
                                        </div>
                                        <div>
                                            <h3 class="text-white font-bold text-lg">Peringkat {{ $index + 1 }}</h3>
                                            @if($index == 0)
                                                <p class="text-yellow-100 text-sm font-medium">🏆 Current Champion</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Player Info -->
                            <div class="p-4">
                                <div class="flex items-center space-x-4 mb-4">
                                    <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                                        <span class="text-white font-bold text-xl">{{ substr($player->name, 0, 1) }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <a href="{{ route('players.profile', $player->id) }}" class="text-xl font-bold text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                                            {{ $player->name }}
                                        </a>
                                        @if($index == 0)
                                            <p class="text-sm text-yellow-600 dark:text-yellow-400 font-medium">Champion</p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Stats Grid -->
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="text-center bg-yellow-50 dark:bg-yellow-900 dark:bg-opacity-20 rounded-xl p-3">
                                        <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $player->wins }}</div>
                                        <div class="text-xs text-yellow-600 dark:text-yellow-400 font-medium">🏆 Tropi</div>
                                    </div>
                                    <div class="text-center bg-blue-50 dark:bg-blue-900 dark:bg-opacity-20 rounded-xl p-3">
                                        <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $player->matches }}</div>
                                        <div class="text-xs text-blue-600 dark:text-blue-400 font-medium">Final</div>
                                    </div>
                                    <div class="text-center bg-purple-50 dark:bg-purple-900 dark:bg-opacity-20 rounded-xl p-3">
                                        <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ number_format($player->avg_score, 1) }}</div>
                                        <div class="text-xs text-purple-600 dark:text-purple-400 font-medium">Rata-rata</div>
                                    </div>
                                </div>

                                <!-- Win Rate -->
                                <div class="mt-4 bg-gray-50 dark:bg-gray-700 rounded-xl p-3">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Win Rate</span>
                                        <span class="text-sm font-bold text-gray-900 dark:text-white">
                                            {{ $player->matches > 0 ? number_format(($player->wins / $player->matches) * 100, 1) : 0 }}%
                                        </span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-green-500 to-green-600 h-2 rounded-full" style="width: {{ $player->matches > 0 ? ($player->wins / $player->matches) * 100 : 0 }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 text-center">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Belum ada data klasemen</h3>
                            <p class="text-gray-500 dark:text-gray-400">Mulai bermain untuk melihat peringkat</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>