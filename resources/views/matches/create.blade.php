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

                    <!-- Improved Documentation Upload Section -->
                    <div class="mb-6">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                            📸 Dokumentasi Pertandingan (Opsional)
                        </label>
                        <div class="relative">
                            <div id="file-upload-area" class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-8 text-center transition-all duration-300 hover:border-blue-400 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div id="upload-placeholder" class="space-y-3">
                                    <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-gray-600 dark:text-gray-300 font-medium">Klik untuk upload foto atau drag & drop</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">PNG, JPG, JPEG hingga 2MB</p>
                                    </div>
                                </div>
                                <div id="preview-container" class="hidden">
                                    <div class="relative inline-block">
                                        <img id="image-preview" class="max-w-full max-h-48 rounded-lg shadow-md" alt="Preview">
                                        <button type="button" id="remove-image" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition-colors">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2" id="file-info"></p>
                                </div>
                            </div>
                            <input type="file" id="documentation" name="documentation" accept="image/*" class="hidden">
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                            💡 Tip: Upload foto skor akhir, momen penting, atau screenshot hasil pertandingan
                        </p>
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
        
        // Player management
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

        // File upload functionality
        const fileUploadArea = document.getElementById('file-upload-area');
        const fileInput = document.getElementById('documentation');
        const uploadPlaceholder = document.getElementById('upload-placeholder');
        const previewContainer = document.getElementById('preview-container');
        const imagePreview = document.getElementById('image-preview');
        const fileInfo = document.getElementById('file-info');
        const removeImageBtn = document.getElementById('remove-image');

        // Click to select file
        fileUploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        // Drag and drop functionality
        fileUploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            fileUploadArea.classList.add('border-blue-400', 'bg-blue-50', 'dark:bg-blue-900');
        });

        fileUploadArea.addEventListener('dragleave', (e) => {
            e.preventDefault();
            fileUploadArea.classList.remove('border-blue-400', 'bg-blue-50', 'dark:bg-blue-900');
        });

        fileUploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            fileUploadArea.classList.remove('border-blue-400', 'bg-blue-50', 'dark:bg-blue-900');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                const file = files[0];
                if (file.type.startsWith('image/')) {
                    handleFileSelection(file);
                } else {
                    alert('Harap pilih file gambar (PNG, JPG, JPEG)');
                }
            }
        });

        // File input change
        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                handleFileSelection(file);
            }
        });

        // Remove image
        removeImageBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            resetFileUpload();
        });

        function handleFileSelection(file) {
            // Validate file size (5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 2MB.');
                return;
            }

            // Validate file type
            if (!file.type.startsWith('image/')) {
                alert('Harap pilih file gambar (PNG, JPG, JPEG)');
                return;
            }

            // Create FileList and set to input
            const dt = new DataTransfer();
            dt.items.add(file);
            fileInput.files = dt.files;

            // Show preview
            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview.src = e.target.result;
                fileInfo.textContent = `${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
                uploadPlaceholder.classList.add('hidden');
                previewContainer.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }

        function resetFileUpload() {
            fileInput.value = '';
            uploadPlaceholder.classList.remove('hidden');
            previewContainer.classList.add('hidden');
            imagePreview.src = '';
            fileInfo.textContent = '';
        }
    </script>
</x-app-layout>