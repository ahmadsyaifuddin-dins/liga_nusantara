<div class="flex items-center space-x-4">
    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
        <span class="text-white font-bold text-lg">{{ substr($user->name, 0, 1) }}</span>
    </div>
    <div>
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200">{{ $user->name }}</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400">Profil Pemain</p>
    </div>
</div>
