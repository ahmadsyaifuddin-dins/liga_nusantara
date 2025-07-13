@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('statsRadarChart').getContext('2d');

    const maxValues = {
        wins: Math.max({{ $wins }}, 10),
        penaltyWins: Math.max({{ $penaltyWins }}, 5),
        goals: Math.max({{ $totalGoals }}, 20),
        highestScore: Math.max({{ $highestScore ?? 0 }}, 10),
        averageScore: Math.max({{ $averageScore ?? 0 }}, 5),
        winRate: 100
    };

    const normalizedData = [
        ({{ $wins }} / maxValues.wins) * 100,
        ({{ $penaltyWins }} / maxValues.penaltyWins) * 100,
        ({{ $totalGoals }} / maxValues.goals) * 100,
        ({{ $highestScore ?? 0 }} / maxValues.highestScore) * 100,
        ({{ $averageScore ?? 0 }} / maxValues.averageScore) * 100,
        {{ number_format($winRate, 2) }}
    ];

    new Chart(ctx, {
        type: 'radar',
        data: {
            labels: [
                'Kemenangan', 'Penalti Wins', 'Total Gol',
                'Skor Tertinggi', 'Rata-rata Skor', 'Win Rate'
            ],
            datasets: [{
                label: '{{ $user->name }}',
                data: normalizedData,
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderColor: 'rgba(59, 130, 246, 0.8)',
                borderWidth: 2,
                pointBackgroundColor: 'rgba(59, 130, 246, 1)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8,
                pointHoverBackgroundColor: 'rgba(59, 130, 246, 1)',
                pointHoverBorderColor: '#fff',
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                r: {
                    beginAtZero: true,
                    max: 100,
                    angleLines: {
                        display: true,
                        color: 'rgba(0, 0, 0, 0.1)'
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    },
                    pointLabels: {
                        font: {
                            size: 12,
                            weight: 'bold'
                        },
                        color: 'rgba(0, 0, 0, 0.7)'
                    },
                    ticks: {
                        display: false,
                        stepSize: 20
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const originalValues = [
                                {{ $wins }},
                                {{ $penaltyWins }},
                                {{ $totalGoals }},
                                {{ $highestScore ?? 0 }},
                                {{ number_format($averageScore, 2) }},
                                {{ number_format($winRate, 2) }}
                            ];
                            const labels = [
                                'Kemenangan: ',
                                'Penalti Wins: ',
                                'Total Gol: ',
                                'Skor Tertinggi: ',
                                'Rata-rata Skor: ',
                                'Win Rate: '
                            ];
                            return labels[context.dataIndex] + originalValues[context.dataIndex] + (context.dataIndex === 5 ? '%' : '');
                        }
                    }
                }
            }
        }
    });
</script>
@endpush
