<div class="my-4 py-10">

    <canvas id="myChart"></canvas>

    @pushOnce('scripts')
        <script type="module">
            const ctx = document.getElementById('myChart');
            new window.chart(ctx, {
                type: "line",
                data: {
                    labels: @json($chart['labels']),
                    datasets: [{
                        label: "Rata Rata nilai perbulan",
                        data: @json($chart['datas']),
                        borderWidth: 1,
                    }, ],
                },

                options: {
                    scales: {
                        y: {
                            max: 100,
                            beginAtZero: true,
                        },
                    },
                    responsive: true,
                },
            });
        </script>
    @endPushOnce

</div>

