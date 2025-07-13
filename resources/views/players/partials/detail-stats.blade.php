<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
    <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 px-6 py-4 border-b dark:border-gray-600">
        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
            </svg>
            Statistik Detail
        </h3>
    </div>
    <div class="p-6">
        <div class="space-y-4">
            <div class="flex justify-between items-center py-3 border-b dark:border-gray-600">
                <span class="text-gray-600 dark:text-gray-300 flex items-center">
                    <span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                    Menang Lewat Penalti
                </span>
                <span class="font-bold text-gray-800 dark:text-gray-200">{{ $penaltyWins }}</span>
            </div>

            <div class="flex justify-between items-center py-3 border-b dark:border-gray-600">
                <span class="text-gray-600 dark:text-gray-300 flex items-center">
                    <span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>
                    Rata-rata Skor
                </span>
                <span class="font-bold text-gray-800 dark:text-gray-200">{{ number_format($averageScore, 2) }}</span>
            </div>

            <div class="flex justify-between items-center py-3 border-b dark:border-gray-600">
                <span class="text-gray-600 dark:text-gray-300 flex items-center">
                    <span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>
                    Skor Tertinggi
                </span>
                <span class="font-bold text-gray-800 dark:text-gray-200">{{ $highestScore }}</span>
            </div>

            {{-- Tambahan kalau ingin nanti --}}
            {{-- <div class="flex justify-between items-center py-3">
                <span class="text-gray-600 dark:text-gray-300 flex items-center">
                    <span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>
                    Total Trofi
                </span>
                <span class="font-bold text-gray-800 dark:text-gray-200">{{ $totalTrophies ?? 0 }}</span>
            </div> --}}
        </div>
    </div>
</div>
