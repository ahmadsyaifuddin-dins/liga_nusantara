<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Riwayat Pertandingan PES
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif
        
                <div class="overflow-x-auto relative">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-300">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                            <tr>
                                <th class="px-4 py-2">No</th>
                                <th class="px-4 py-2">Judul</th>
                                <th class="px-4 py-2">Tanggal</th>
                                <th class="px-4 py-2">Pemain & Skor</th>
                                <th class="px-4 py-2">Pemenang</th>
                                <th class="px-4 py-2">Dokumentasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($matches as $index => $match)
                                <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700">
                                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3">{{ $match->judul }}</td>
                                    <td class="px-4 py-3">{{ $match->created_at->format('d M Y H:i') }}</td>

                                    <td class="px-4 py-3">
                                        <ul class="list-disc pl-4">
                                            @foreach($match->players as $player)
                                                <li>
                                                    {{ $player->user->name }} - <span class="font-bold">{{ $player->score }}</span>
                                                    @if($player->is_winner)
                                                        <span class="text-green-500 font-semibold"> (Menang)</span>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>

                                    <td class="px-4 py-3 font-bold">
                                        {{ optional($match->winner)->name ?? 'Seri' }}
                                    </td>

                                    <td class="px-4 py-3">
                                        @if($match->documentation)
                                            <a href="{{ asset('storage/' . $match->documentation) }}" target="_blank" class="text-blue-500 hover:underline">Lihat Dokumentasi</a>
                                        @else
                                            Tidak ada dokumentasi
                                        @endif
                                        
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                                        Belum ada pertandingan tercatat
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
