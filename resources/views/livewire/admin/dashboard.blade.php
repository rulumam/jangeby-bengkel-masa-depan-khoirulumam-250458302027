<div class="space-y-6 p-6 md:p-8 min-h-screen bg-gray-900 text-gray-100">

    <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
        <div class="bg-gray-900 p-5 rounded-xl border border-gray-800">
            <p class="text-gray-400">Total Perbaikan</p>
            <h2 class="text-3xl font-semibold" style="color:#4CE9C3;">{{ $totalRepairs }}</h2>
        </div>

        <div class="bg-gray-900 p-5 rounded-xl border border-gray-800">
            <p class="text-gray-400">Done</p>
            <h2 class="text-3xl font-semibold text-green-400">{{ $completed }}</h2>
        </div>

        <div class="bg-gray-900 p-5 rounded-xl border border-gray-800">
            <p class="text-gray-400">Process</p>
            <h2 class="text-3xl font-semibold text-yellow-400">{{ $pending }}</h2>
        </div>

        <div class="bg-gray-900 p-5 rounded-xl border border-gray-800">
            <p class="text-gray-400">Cancelled</p>
            <h2 class="text-3xl font-semibold text-red-400">{{ $cancelled }}</h2>
        </div>

        <div class="bg-gray-900 p-5 rounded-xl border border-gray-800">
            <p class="text-gray-400">Paid</p>
            <h2 class="text-3xl font-semibold text-amber-400">{{ $paid }}</h2>
        </div>
    </div>

    {{-- Chart Section --}}
    <div class="w-full mt-6">
        <div class="bg-gray-900 shadow-xl rounded-2xl border border-gray-800">
            <div class="p-6 pb-0">
                <h6 class="text-lg font-semibold" style="color:#4CE9C3;">Statistik Perbaikan Harian</h6>
                <p class="text-sm text-gray-400">
                    <i class="fa fa-calendar text-emerald-400"></i>
                    <span class="font-semibold">Bulan {{ now()->format('F Y') }}</span>
                </p>
            </div>

            <div class="flex-auto p-0 md:p-6" style="height: 350px;">
                <canvas id="chart-bar"></canvas>
            </div>
        </div>
    </div>

</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('chart-bar').getContext('2d');

    const labels = @json($days);
    const dailyRepairs = @json($dailyRepairs);
    const dailyPaid = @json($dailyPaid);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Total Perbaikan',
                    data: dailyRepairs,
                    backgroundColor: 'rgba(76, 233, 195, 0.35)',
                    borderColor: '#4CE9C3',
                    borderWidth: 2,
                    borderRadius: 6
                },
                {
                    label: 'Paid',
                    data: dailyPaid,
                    backgroundColor: 'rgba(255, 193, 7, 0.35)',
                    borderColor: '#FFC107',
                    borderWidth: 2,
                    borderRadius: 6
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: "#9CA3AF",
                        font: { size: 12 },
                        padding: 16
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: "rgba(255,255,255,0.05)",
                        drawBorder: false
                    },
                    ticks: {
                        color: "#9CA3AF",
                        stepSize: 1
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: {
                        color: "#9CA3AF",
                        maxRotation: 60,
                        minRotation: 45
                    }
                }
            }
        }
    });
});
</script>
