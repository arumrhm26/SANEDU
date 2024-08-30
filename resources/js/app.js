import "./bootstrap";
import "../../vendor/masmerise/livewire-toaster/resources/js"; // 👈
// import "./scan-qr";

// import Alpine from "alpinejs";
import Chart from "chart.js/auto";
import { Html5QrcodeScanner } from "html5-qrcode";
import Granim from "granim";
import.meta.glob(["../images/**", "../fonts/**"]);

window.chart = Chart;
window.html5QrcodeScanner = Html5QrcodeScanner;
// window.granim = Granim;

// window.addEventListener("load", () => {
//     const ctx = document.getElementById("myChart");
//     if (!ctx) {
//         return;
//     }

// });
