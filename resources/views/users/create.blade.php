<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Akun Player
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="block font-medium text-sm text-gray-700">Nama</label>
                            <input type="text" name="name" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="block font-medium text-sm text-gray-700">Email Player</label>
                            <input type="email" name="email" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="block font-medium text-sm text-gray-700">Password Default</label>
                            <input type="password" name="password" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>

                        <button class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 transition" type="submit">
                            Tambah Player
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
