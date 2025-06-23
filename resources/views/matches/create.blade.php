<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Pertandingan PES
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('matches.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Judul Pertandingan <span class="text-red-500">*</span></label>
                        <input type="text" name="judul" class="w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white" placeholder="Contoh: Final Turnamen CUP, Final Turnamen Klub Liga Inggris" required>
                    </div>

                    <div id="players-container">
                        @for($i = 0; $i < 2; $i++)
                            <div class="flex space-x-4 mb-3 player-entry">
                                <div class="w-2/3">
                                    <label class="text-sm text-gray-600 dark:text-gray-300">Pemain</label>
                                    <select name="players[{{ $i }}][user_id]" class="w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white" required>
                                        <option value="">-- Pilih Pemain --</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-1/3">
                                    <label class="text-sm text-gray-600 dark:text-gray-300">Skor</label>
                                    <input type="number" name="players[{{ $i }}][score]" class="w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white" min="0" required>
                                </div>
                            </div>
                        @endfor
                    </div>

                    <div class="mt-2 mb-6">
                        <label class="text-sm text-gray-600 dark:text-gray-300">Menang karena penalti (jika skor seri):</label>
                        <select name="penalty_winner_id" class="w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white">
                            <option value="">-- Tidak Ada --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-between items-center mb-6">
                        <button type="button" id="add-player" class="px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">+ Tambah Pemain</button>
                        <button type="button" id="remove-player" class="px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600">- Hapus Pemain</button>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Dokumentasi (Opsional)</label>
                        <input type="file" name="documentation" accept="image/*" class="w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white">
                    </div>

                    <div>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Simpan Pertandingan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let index = 4;
        const users = @json($users);
        const container = document.getElementById('players-container');
        document.getElementById('add-player').addEventListener('click', () => {
            if(index >= 6) return alert('Maksimal 6 pemain!');
            const div = document.createElement('div');
            div.className = 'flex space-x-4 mb-3 player-entry';
            div.innerHTML = `
                <div class="w-2/3">
                    <label class="text-sm text-gray-600 dark:text-gray-300">Pemain</label>
                    <select name="players[${index}][user_id]" class="w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white" required>
                        <option value="">-- Pilih Pemain --</option>
                        ${users.map(user => `<option value="${user.id}">${user.name}</option>`).join('')}
                    </select>
                </div>
                <div class="w-1/3">
                    <label class="text-sm text-gray-600 dark:text-gray-300">Skor</label>
                    <input type="number" name="players[${index}][score]" class="w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white" min="0" required>
                </div>
            `;
            container.appendChild(div);
            index++;
        });

        document.getElementById('remove-player').addEventListener('click', () => {
            if(index <= 2) return alert('Minimal 2 pemain!');
            const last = container.querySelector('.player-entry:last-child');
            if (last) last.remove();
            index--;
        });
    </script>
</x-app-layout>
