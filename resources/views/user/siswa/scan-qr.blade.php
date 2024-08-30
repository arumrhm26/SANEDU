<x-user-layout>
    <div id="reader"
         class="max-w-screen-md mx-auto"></div>
    {{-- <div id="result"
         class="max-w-screen-sm mx-auto min-h-screen  flex justify-center items-center px-4">
    </div> --}}

    @push('scripts')
        <script type="module">
            // barcode scanner
            function onScanSuccess(decodedText, decodedResult) {
                html5QrcodeScanner.clear();

                const axios = window.axios;
                axios.post('/siswa/scan-qr', {
                    'code': decodedText
                }).then((response) => {
                    const data = response.data;
                    alert(data.message);
                    window.location.href = '/siswa';
                }).catch((error) => {
                    console.error(error);
                    alert('Gagal melakukan scan QR');
                    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
                });

            }

            function onScanFailure(error) {}

            const html5QrcodeScanner = new window.html5QrcodeScanner(
                "reader", {
                    fps: 10,
                    qrbox: 250,
                },
                false,
            );

            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        </script>
    @endPush
</x-user-layout>

