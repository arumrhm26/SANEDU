@php
    $chart = [
        'labels' => $latestTahunAjaran->pluck('name')->toArray(),
        'data' => $latestTahunAjaran->map(fn($tahunAjaran) => $tahunAjaran->class_room_students_count)->toArray(),
    ];

    // check if chart data is < 5
    if (count($chart['data']) < 5) {
        $chart['labels'] = array_merge($chart['labels'], array_fill(0, 5 - count($chart['data']), ''));
        $chart['data'] = array_merge($chart['data'], array_fill(0, 5 - count($chart['data']), 0));
    }

@endphp

<div class="p-5 pb-10 bg-[#D9D9D9] mt-5 rounded-xl w-full flex flex-col items-center md:h-[500px]">

    <div class="text-center">
        <span class="font-bold text-xl">Grafik Jumlah Siswa Aktif</span>
    </div>
    <canvas id="myChart"></canvas>

    @pushOnce('scripts')
        <script type="module">
            const ctx = document.getElementById('myChart');
            new window.chart(ctx, {
                type: "bar",
                data: {
                    labels: @json($chart['labels']),
                    datasets: [{
                        label: "# Jumlah Siswa",
                        data: @json($chart['data']),
                        borderWidth: 1,
                    }, ],
                },

                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                    backgroundColor: "#063970",
                    responsive: true,
                },
            });
        </script>
    @endPushOnce

</div>

