// import { Html5QrcodeScanner } from "html5-qrcode";

// if (document.getElementById("reader")) {
//     // barcode scanner
//     function onScanSuccess(decodedText, decodedResult) {
//         // handle the scanned code as you like, for example:
//         console.log(`Code matched = ${decodedText}`, decodedResult);

//         // Optional: To close the QR code scanner after the successful scan
//         html5QrcodeScanner.clear();

//         document.getElementById("result").innerHTML = decodedText;
//     }

//     function onScanFailure(error) {
//         // handle scan failure, usually better to ignore and keep scanning.
//         // for example:
//         // console.warn(`Code scan error = ${error}`);
//     }

//     const html5QrcodeScanner = new Html5QrcodeScanner(
//         "reader",
//         { fps: 10, qrbox: 250 },
//         /* verbose= */ false,
//     );

//     html5QrcodeScanner.render(onScanSuccess, onScanFailure);
// }
