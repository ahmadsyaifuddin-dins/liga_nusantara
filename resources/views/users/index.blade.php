<x-app-layout>
    <x-slot name="header">
        <h2>Daftar Player</h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <table class="table-auto w-full text-left">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($players as $player)
                        <tr>
                            <td>{{ $player->name }}</td>
                            <td>{{ $player->email }}</td>
                            <td>
                                @if($player->is_active)
                                    <span class="text-green-600">Aktif</span>
                                @else
                                    <span class="text-red-600">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('users.toggle', $player->id) }}" method="POST">
                                    @csrf
                                    <button class="px-3 py-1 bg-indigo-500 text-white rounded hover:bg-indigo-600">
                                        {{ $player->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
