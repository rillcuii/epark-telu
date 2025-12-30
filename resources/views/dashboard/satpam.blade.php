@extends('layouts.satpam')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-1 space-y-6">
            <div
                class="bg-gradient-to-br from-red-600 to-red-700 p-6 rounded-3xl shadow-xl shadow-red-100 text-white relative overflow-hidden group">
                <div class="relative z-10">
                    <h3 class="text-xl font-black uppercase tracking-tight mb-2">Generate QR Code</h3>
                    <p class="text-xs text-red-100 mb-6 opacity-80">Tampilkan QR Code ini untuk di-scan oleh mahasiswa di
                        pintu masuk/keluar.</p>
                    <button
                        class="w-full bg-white text-red-600 py-3 rounded-xl font-bold text-sm hover:bg-red-50 transition-all flex items-center justify-center gap-2">
                        <i class="fas fa-qrcode text-lg"></i> TAMPILKAN QR
                    </button>
                </div>
                <i
                    class="fas fa-shield-alt absolute -right-4 -bottom-4 text-8xl text-white/10 group-hover:rotate-12 transition-transform"></i>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4">Ringkasan Hari Ini</h4>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-500">Total Scan</span>
                        <span class="text-sm font-bold text-gray-900">128</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-500">Kendaraan Masuk</span>
                        <span class="text-sm font-bold text-emerald-600">+84</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex items-center justify-between">
                    <h3 class="font-black text-gray-800 uppercase tracking-tight">Data Scan Terbaru</h3>
                    <span class="flex h-2 w-2 rounded-full bg-red-600 animate-ping"></span>
                </div>

                <div class="divide-y divide-gray-50">
                    @forelse($recentScans as $scan)
                        <div
                            class="p-5 hover:bg-gray-50 transition-colors flex flex-wrap md:flex-nowrap items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 bg-gray-100 rounded-2xl flex items-center justify-center text-gray-500">
                                    <i class="fas fa-car-side"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-black text-gray-900">{{ $scan->kendaraan->plat_nomor }}</h4>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">
                                        {{ $scan->kendaraan->model_kendaraan }}</p>
                                </div>
                            </div>

                            <div class="text-center md:text-left">
                                <p class="text-[9px] text-gray-400 uppercase font-bold">Waktu Scan</p>
                                <p class="text-xs font-bold text-gray-700">
                                    {{ \Carbon\Carbon::parse($scan->waktu_masuk)->format('H:i:s') }}</p>
                            </div>

                            <div class="flex items-center gap-3">
                                <span
                                    class="px-3 py-1 rounded-full text-[9px] font-black uppercase {{ $scan->status == 'masuk' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $scan->status }}
                                </span>
                                <a href=""
                                    class="bg-gray-900 text-white px-4 py-2 rounded-xl text-[10px] font-bold hover:bg-red-600 transition shadow-sm">
                                    VERIFIKASI
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="py-20 text-center">
                            <i class="fas fa-camera-retro text-4xl text-gray-200 mb-4"></i>
                            <p class="text-sm text-gray-400 italic">Tidak ada data scan terbaru.</p>
                        </div>
                    @endforelse
                </div>

                <a href="{{ route('satpam.riwayat_parkir') }}"
                    class="block p-4 text-center bg-gray-50 text-[10px] font-black text-gray-500 hover:text-red-600 uppercase tracking-widest transition">
                    Lihat Semua Aktivitas
                </a>
            </div>
        </div>
    </div>
@endsection
