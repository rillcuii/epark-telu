@extends('layouts.satpam')

@section('content')
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-[430px] z-50">
        <div class="bg-figmaRed h-32 flex items-center px-8 rounded-b-[40px] shadow-lg">
            <a href="{{ route('satpam.dashboard') }}" class="text-white text-2xl mr-6 transition active:scale-90">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-white text-xl font-bold tracking-tight">Generate Qr Code</h1>
        </div>
    </div>

    <div class="px-6 mt-16">
        <div class="bg-white rounded-[32px] shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex justify-between items-center px-6 py-4 border-b border-gray-50">
                <span class="font-bold text-gray-800 text-sm tracking-tight">QR Code</span>
                <button onclick="fetchNewQR()" class="text-[#EE2B2B] hover:rotate-180 transition-transform duration-500">
                    <i id="refresh-icon" class="fas fa-sync-alt"></i>
                </button>
            </div>

            <div class="p-10 flex justify-center items-center bg-white">
                <div id="qr-container" class="relative group">
                    <div id="qrcode-img" class="p-2 border-2 border-gray-50 rounded-xl"></div>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center px-4">
            <div class="flex items-center justify-center gap-2 mb-4">
                <div class="h-[1px] bg-gray-200 flex-grow max-w-[40px]"></div>
                <h2 id="current-date" class="text-[11px] font-bold text-gray-500 uppercase tracking-[0.2em]">
                    {{ now()->translatedFormat('l, d M Y') }}
                </h2>
                <div class="h-[1px] bg-gray-200 flex-grow max-w-[40px]"></div>
            </div>

            <p class="text-[11px] text-gray-400 font-medium leading-relaxed">
                Qr Code akan digenerate oleh system<br>setiap 10 menit
            </p>
            <p id="display-id" class="text-[9px] text-gray-300 mt-2 font-mono">Memuat ID...</p>

            <div class="mt-16 flex justify-center opacity-80">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('assets/images/image.png') }}" alt="Logo" class="h-20">
                </div>
            </div>
        </div>
    </div>

    <div id="modal-error-404"
        class="hidden fixed inset-0 z-[99] flex items-center justify-center px-8 bg-black/20 backdrop-blur-sm">
        <div class="bg-white rounded-[32px] p-8 w-full max-w-xs text-center shadow-2xl relative">
            <button onclick="closeModal('modal-error-404')"
                class="absolute top-4 right-6 text-gray-300 text-lg">&times;</button>
            <div class="mb-4 flex justify-center">
                <i class="fas fa-server text-5xl text-gray-800"></i>
            </div>
            <h3 class="text-2xl font-black text-gray-900 mb-1">404</h3>
            <p class="text-[13px] font-bold text-gray-900 mb-2">Server Eror</p>
            <p class="text-[10px] text-gray-400 mb-6 leading-relaxed">Server eror, coba lagi nanti!</p>
            <button onclick="closeModal('modal-error-404')"
                class="w-full py-3 bg-[#EE2B2B] text-white rounded-xl text-xs font-bold shadow-lg shadow-red-200">
                Oke, Mengerti
            </button>
        </div>
    </div>

    <div id="modal-error-conn"
        class="hidden fixed inset-0 z-[99] flex items-center justify-center px-8 bg-black/20 backdrop-blur-sm">
        <div class="bg-white rounded-[32px] p-8 w-full max-w-xs text-center shadow-2xl relative">
            <button onclick="closeModal('modal-error-conn')"
                class="absolute top-4 right-6 text-gray-300 text-lg">&times;</button>
            <div class="mb-4 flex justify-center text-[#EE2B2B]">
                <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center">
                    <i class="fas fa-wifi text-2xl"></i>
                </div>
            </div>
            <p class="text-[13px] font-bold text-gray-900 mb-2">Koneksi terputus</p>
            <p class="text-[10px] text-gray-400 mb-6 leading-relaxed px-4">Koneksi terputus, QR Code tidak dapat
                diperbarui. Mohon periksa koneksi Anda!</p>
            <button onclick="closeModal('modal-error-conn')"
                class="w-full py-3 bg-[#EE2B2B] text-white rounded-xl text-xs font-bold shadow-lg shadow-red-200">
                Oke, Mengerti
            </button>
        </div>
    </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        const qrContainer = document.getElementById("qrcode-img");
        const displayId = document.getElementById("display-id");
        const refreshIcon = document.getElementById("refresh-icon");

        // Inisialisasi QRCode.js (Ukuran disesuaikan agar pas di card)
        let qrcode = new QRCode(qrContainer, {
            width: 200,
            height: 200,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });

        function showModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        async function fetchNewQR() {
            refreshIcon.classList.add('fa-spin');

            try {
                const response = await fetch("{{ route('satpam.get_new_qr') }}");
                if (!response.ok) throw new Error('server_error');

                const data = await response.json();

                if (data.success) {
                    qrcode.makeCode(data.kode_unik);
                    displayId.innerText = "ID QR: " + data.id_qrcode;
                    document.getElementById("current-date").innerText = data.date_full;
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                if (!navigator.onLine) {
                    showModal('modal-error-conn');
                } else {
                    showModal('modal-error-404');
                }
            } finally {
                refreshIcon.classList.remove('fa-spin');
            }
        }

        // Jalankan pertama kali
        fetchNewQR();

        // Auto-refresh 10 menit
        setInterval(fetchNewQR, 600000);
    </script>
@endsection
