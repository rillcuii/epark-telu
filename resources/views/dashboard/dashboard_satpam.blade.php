@extends('layouts.satpam')

@section('content')
    <div class="mt-16">
        <div class="flex justify-between items-end mb-6">
            <div>
                <h2 class="text-xl font-extrabold text-gray-900 leading-none">Aktivitas Parkir</h2>
                <p class="text-[10px] font-bold text-figmaRed uppercase tracking-widest mt-2">
                    Hari Ini: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                </p>
            </div>
        </div>

        <div class="space-y-4 mb-32">
            @php
                // Filter koleksi agar hanya menampilkan data yang waktu_masuk-nya hari ini
                $scansToday = $recentScans->filter(function ($scan) {
                    return \Carbon\Carbon::parse($scan->waktu_masuk)->isToday();
                });
            @endphp

            @forelse ($scansToday as $scan)
                @php
                    $isInside = is_null($scan->waktu_keluar);
                @endphp

                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm flex items-stretch overflow-hidden h-20">
                    {{-- Indikator Warna --}}
                    <div class="w-2 {{ $isInside ? 'bg-[#2B7AEE]' : 'bg-emerald-500' }}"></div>

                    <div class="flex-grow flex items-center justify-between px-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user {{ $isInside ? 'text-gray-300' : 'text-emerald-200' }} text-lg"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-black text-gray-900 leading-none">
                                    {{ $scan->kendaraan->nomor_polisi }}
                                </h4>
                                <p class="text-[9px] font-bold text-gray-400 uppercase mt-1">
                                    {{ $scan->kendaraan->model_kendaraan }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="text-[9px] text-gray-400 font-bold border-l border-gray-100 pl-3 leading-relaxed">
                                <p>Masuk: <span
                                        class="text-gray-900">{{ \Carbon\Carbon::parse($scan->waktu_masuk)->format('H:i') }}</span>
                                </p>

                                @if ($isInside)
                                    <p class="text-[#2B7AEE] flex items-center gap-1">
                                        <span class="relative flex h-1.5 w-1.5">
                                            <span
                                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-blue-500"></span>
                                        </span>
                                        Masih Parkir
                                    </p>
                                @else
                                    <p>Keluar: <span
                                            class="text-emerald-600">{{ \Carbon\Carbon::parse($scan->waktu_keluar)->format('H:i') }}</span>
                                    </p>
                                @endif
                            </div>

                            <a href="{{ route('satpam.verifikasi', $scan->id_parkir) }}"
                                class="w-8 h-8 bg-gray-50 rounded-lg flex items-center justify-center text-gray-400 border border-gray-100 hover:bg-gray-100 active:scale-95 transition-all">
                                <i class="fas fa-list-ul text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Tampilan jika benar-benar belum ada scan hari ini --}}
                <div class="flex flex-col items-center justify-center py-24 opacity-40 text-center">
                    <div class="w-20 h-20 bg-gray-100 rounded-[30px] flex items-center justify-center mb-4">
                        <i class="fas fa-calendar-day text-4xl text-gray-300"></i>
                    </div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Belum Ada Scan</p>
                    <p class="text-[10px] text-gray-400 mt-1">Data scan hari ini akan muncul di sini</p>
                </div>
            @endforelse
        </div>

        {{-- Tombol QR Floating --}}
        <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[430px] flex justify-center z-50">
            <div class="relative w-full flex justify-center">
                {{-- Background Notch --}}
                <div class="absolute bottom-0 w-full h-10 bg-white shadow-[0_-5px_15px_rgba(0,0,0,0.03)]"
                    style="clip-path: polygon(0 0, 38% 0, 42% 40%, 50% 60%, 58% 40%, 62% 0, 100% 0, 100% 100%, 0 100%);">
                </div>

                {{-- Container Tombol --}}
                <div class="relative -top-6 bg-white p-2 rounded-full shadow-lg">
                    {{-- Mengubah button menjadi tag 'a' agar bisa melakukan navigasi --}}
                    <a href="{{ route('satpam.qr_display') }}"
                        class="w-14 h-14 bg-[#F1F3F4] rounded-full flex items-center justify-center border border-gray-100 shadow-inner active:scale-90 transition-transform decoration-transparent">
                        <i class="fas fa-qrcode text-2xl text-gray-800"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
