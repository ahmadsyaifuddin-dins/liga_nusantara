<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Klasemen Pemain PES
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="overflow-x-auto relative">
                <table class="w-full table-auto text-sm text-left text-gray-500 dark:text-gray-300">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700 text-xs text-gray-700 uppercase dark:text-gray-300">
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">🏆 Tropi</th>
                            <th class="px-4 py-2">Final</th>
                            <th class="px-4 py-2">Skor Rata-rata</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($players as $index => $player)
                            <tr class="border-b dark:border-gray-600">
                                <td class="px-4 py-2">{{ $index + 1 }}</td>
                                <td class="px-4 py-2">{{ $player->name }}</td>
                                <td class="px-4 py-2">{{ $player->wins }} </td>
                                <td class="px-4 py-2">{{ $player->matches }}</td>
                                <td class="px-4 py-2">{{ number_format($player->avg_score, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-400">Belum ada data klasemen</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
