@extends('layouts.mahasiswa')

@section('content')
    <div
        class="relative min-h-[80vh] -m-6 md:-m-10 overflow-hidden bg-slate-950 rounded-[2rem] shadow-2xl border-4 border-white">

        <div class="absolute inset-0 z-10">
            <div id="reader" class="h-full w-full bg-black"></div>
        </div>

        <div class="absolute inset-0 z-20 flex flex-col pointer-events-none">
            <div class="flex-grow bg-slate-950/70"></div>

            <div class="flex h-64">
                <div class="flex-grow bg-slate-950/70"></div>
                <div class="relative w-64 h-64 border-0">
                    <div class="absolute top-0 left-0 w-10 h-10 border-l-4 border-t-4 border-white rounded-tl-lg"></div>
                    <div class="absolute top-0 right-0 w-10 h-10 border-r-4 border-t-4 border-white rounded-tr-lg"></div>
                    <div class="absolute bottom-0 left-0 w-10 h-10 border-l-4 border-b-4 border-white rounded-bl-lg"></div>
                    <div class="absolute bottom-0 right-0 w-10 h-10 border-r-4 border-b-4 border-white rounded-br-lg"></div>

                    <div
                        class="absolute top-2 left-2 right-2 h-0.5 bg-indigo-400 shadow-[0_0_10px_rgba(129,140,248,0.8)] animate-scan">
                    </div>
                </div>
                <div class="flex-grow bg-slate-950/70"></div>
            </div>

            <div class="flex-grow bg-slate-950/70 flex justify-center pt-6">
                <p class="text-xs font-medium text-slate-200 tracking-wide">Arahkan kamera pada QR Code yang ada di layar
                    Satpam</p>
            </div>
        </div>

        <div
            class="absolute bottom-0 left-0 right-0 z-30 p-6 pt-10 bg-white rounded-t-[2.5rem] shadow-[0_-10px_25px_rgba(0,0,0,0.1)] border-t border-slate-100">
            <div class="absolute top-4 left-1/2 -translate-x-1/2 w-12 h-1 bg-slate-200 rounded-full"></div>

            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-black text-slate-900 tracking-tight">SCAN QR PARKIR</h2>
                    <p class="text-xs font-bold text-indigo-500 uppercase tracking-widest mt-1">Sesi:
                        {{ $activeParking ? 'KELUAR' : 'MASUK' }}</p>
                </div>
                <a href="{{ route('mahasiswa.pilih_kendaraan') }}"
                    class="text-xs font-bold text-slate-400 hover:text-red-600 transition">
                    <i class="fas fa-times mr-1"></i> Batal
                </a>
            </div>

            <div id="result-message"
                class="hidden p-4 rounded-2xl text-center font-bold text-sm mb-5 transform transition-all scale-95 opacity-0">
            </div>

            <div class="p-5 bg-slate-50 rounded-3xl border border-slate-100 flex items-center gap-4">
                <div
                    class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-slate-400 border border-slate-100 shadow-sm">
                    <i class="fas fa-motorcycle text-2xl"></i>
                </div>
                <div class="flex-grow">
                    <div class="flex items-center gap-2">
                        <p class="text-lg font-black text-slate-900 leading-none">{{ $kendaraan->nomor_polisi }}</p>
                    </div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mt-1.5">
                        {{ $kendaraan->model_kendaraan }}</p>
                </div>
                <span
                    class="px-3 py-1.5 bg-indigo-50 text-indigo-700 rounded-full font-bold text-[10px] uppercase tracking-wider">Digunakan</span>
            </div>

            <div id="custom-upload-container" class="mt-6 text-center">
                <p class="text-xs text-slate-400 mb-3">Masalah kamera? Gunakan opsi upload.</p>
                <input type="file" id="hidden-file-input" accept="image/*" class="hidden">

                <button id="trigger-scan-file" type="button" class="...">
                    <i class="fas fa-image text-lg"></i>
                    Scan an Image File
                </button>
            </div>
        </div>
    </div>

    <style>
        /* Styling agar video memenuhi kontainer dan tidak ada UI bawaan scannner yang ganggu */
        #reader__scan_region {
            background: #000 !important;
        }

        #reader__scan_region video {
            object-fit: cover !important;
            height: 100% !important;
            width: 100% !important;
        }

        #reader__dashboard,
        #reader__camera_selection {
            display: none !important;
        }

        /* Sembunyikan UI default scannner */
        #reader__status_span {
            color: white !important;
            font-size: 10px !important;
        }

        /* Garis Laser Scanning */
        @keyframes scanLine {
            0% {
                top: 5%;
                opacity: 0.5;
            }

            50% {
                opacity: 1;
            }

            100% {
                top: 95%;
                opacity: 0.5;
            }
        }

        .animate-scan {
            animation: scanLine 2.5s linear infinite;
        }
    </style>

    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        // 1. Inisialisasi Instansi Utama
        // Kita gunakan 'Html5Qrcode' (bukan Scanner) untuk kontrol penuh
        const html5QrCode = new Html5Qrcode("reader");
        const msg = document.getElementById('result-message');
        const fileInput = document.getElementById('hidden-file-input');

        // 2. Fungsi untuk memproses teks QR (baik dari kamera maupun file)
        function handleQrCodeSuccess(decodedText) {
            // Hentikan kamera jika sedang aktif
            if (html5QrCode.isScanning) {
                html5QrCode.stop().catch(err => console.error(err));
            }

            fetch("{{ route('mahasiswa.scan_proses') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        kode_unik: decodedText,
                        id_kendaraan: "{{ $kendaraan->id_kendaraan }}"
                    })
                })
                .then(response => response.json())
                .then(data => {
                    msg.classList.remove('hidden');
                    msg.innerText = data.message;
                    msg.className =
                        `p-4 rounded-2xl text-center font-bold text-sm mb-5 transform transition-all scale-100 opacity-100 ${data.success ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'}`;

                    if (data.success) {
                        setTimeout(() => window.location.href = "{{ route('mahasiswa.dashboard') }}", 2000);
                    }
                })
                .catch(err => alert("Terjadi kesalahan koneksi ke server."));
        }

        // 3. Jalankan Kamera (Akan otomatis gagal jika di IP/HTTP, tapi tidak apa-apa)
        html5QrCode.start({
                facingMode: "environment"
            }, {
                fps: 20,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            handleQrCodeSuccess
        ).catch(err => {
            // Tampilkan pesan error di dalam kotak scanner jika kamera diblokir
            document.getElementById('reader').innerHTML = `
            <div class="flex flex-col items-center justify-center h-full p-8 text-center text-white/50">
                <i class="fas fa-camera-slash text-3xl mb-3"></i>
                <p class="text-[10px] leading-relaxed">Kamera tidak dapat diakses (Insecure Context).<br>Silakan gunakan tombol "Scan an Image File".</p>
            </div>`;
        });

        // 4. LOGIKA TOMBOL UPLOAD (SOLUSI ERROR KAMU)
        const btnUpload = document.getElementById('trigger-scan-file');

        btnUpload.addEventListener('click', function() {
            // Langsung arahkan ke input file buatan kita sendiri
            fileInput.click();
        });

        fileInput.addEventListener('change', e => {
            if (e.target.files.length === 0) return;

            const imageFile = e.target.files[0];
            // Gunakan library untuk membaca file gambar tersebut
            html5QrCode.scanFile(imageFile, true)
                .then(decodedText => {
                    handleQrCodeSuccess(decodedText);
                })
                .catch(err => {
                    alert("QR Code tidak ditemukan pada gambar. Pastikan foto jelas dan terang.");
                });
        });
    </script>
@endsection
