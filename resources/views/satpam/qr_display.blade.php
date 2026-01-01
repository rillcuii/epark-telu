@extends('layouts.satpam')

@section('content')
    <div class="max-w-2xl mx-auto py-6">
        <div class="bg-white rounded-[2.5rem] shadow-xl border border-gray-100 overflow-hidden text-center p-8 md:p-12">

            <div class="mb-8">
                <h2 id="current-date" class="text-lg font-black text-gray-900 uppercase tracking-tighter">
                    {{ now()->translatedFormat('d F Y') }}
                </h2>
                <div class="flex items-center justify-center gap-2 mt-1">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                    <p id="display-id" class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Memuat...</p>
                </div>
            </div>

            <div id="error-message"
                class="hidden mb-6 p-4 bg-red-50 border border-red-100 rounded-2xl text-red-600 text-[11px] font-bold italic">
            </div>

            <div class="relative inline-block group">
                <div id="qr-container" class="p-6 bg-white border-4 border-red-600 rounded-[2rem] shadow-lg shadow-red-50">
                    <div id="qrcode-img" class="mx-auto"></div>
                </div>

                <button onclick="fetchNewQR()"
                    class="absolute -bottom-4 -right-4 w-12 h-12 bg-slate-900 text-white rounded-2xl hover:bg-red-600 transition-all shadow-xl flex items-center justify-center">
                    <i id="refresh-icon" class="fas fa-sync-alt"></i>
                </button>
            </div>

            <div class="mt-12 p-6 bg-gray-50 rounded-3xl border border-dashed border-gray-200">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Interval Update</p>
                <p class="text-xs font-bold text-gray-700">QR Code berganti otomatis setiap 10 menit</p>
                <p class="text-[9px] text-gray-400 mt-4 italic">Terakhir diperbarui jam: <span id="last-update">--:--</span>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        const qrContainer = document.getElementById("qrcode-img");
        const lastUpdateText = document.getElementById("last-update");
        const displayId = document.getElementById("display-id");
        const errorDiv = document.getElementById("error-message");
        const refreshIcon = document.getElementById("refresh-icon");

        // Inisialisasi QRCode.js
        let qrcode = new QRCode(qrContainer, {
            width: 250,
            height: 250,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });

        async function fetchNewQR() {
            refreshIcon.classList.add('fa-spin');
            errorDiv.classList.add('hidden');

            try {
                const response = await fetch("{{ route('satpam.get_new_qr') }}");
                const data = await response.json();

                if (data.success) {
                    // Gunakan kode_unik untuk isi QR Code
                    qrcode.makeCode(data.kode_unik);

                    // Update UI
                    displayId.innerText = "ID QR: " + data.id_qrcode;
                    lastUpdateText.innerText = data.generated_at;
                    document.getElementById("current-date").innerText = data.date_full;
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                errorDiv.classList.remove('hidden');
                if (!navigator.onLine) {
                    errorDiv.innerText =
                    "Koneksi terputus. QR Code tidak dapat diperbarui. Mohon periksa koneksi Anda.";
                } else {
                    errorDiv.innerText =
                        "Kesalahan, Server error 404, Coba Lagi Nanti!. QR Code terakhir tetap ditampilkan.";
                }
            } finally {
                refreshIcon.classList.remove('fa-spin');
            }
        }

        // Jalankan pertama kali
        fetchNewQR();

        // Auto-refresh 10 menit (600.000 ms) sesuai UC010
        setInterval(fetchNewQR, 600000);
    </script>
@endsection
