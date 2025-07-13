<x-app-layout>
    <x-slot name="header">
        @include('players.partials.header', ['user' => $user])
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('players.partials.stat-cards')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @include('players.partials.detail-stats')
                @include('players.partials.radar-chart')
            </div>

            @include('players.partials.performance-metrics')
        </div>
    </div>

    @push('scripts')
        @include('players.partials.chart-script')
    @endpush
</x-app-layout>
