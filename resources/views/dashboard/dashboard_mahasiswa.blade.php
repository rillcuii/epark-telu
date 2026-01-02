@extends('layouts.mahasiswa')

@section('content')
    <div class="p-6 max-w-md mx-auto">
        <div class="mb-8">
            <h1 class="text-2xl font-black text-gray-900">Halo, {{ auth()->user()->nama_user }}! 👋</h1>
            <p class="text-sm text-gray-500 font-medium">NIM: {{ auth()->user()->nim }}</p>
        </div>

        <div class="bg-gray-900 text-white p-6 rounded-3xl mb-6 shadow-xl relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-xs opacity-60 uppercase font-bold tracking-widest mb-1">Status Parkir Saat Ini</p>
                <h2 class="text-xl font-bold">Di Luar Area</h2> {{-- Nanti bisa dibuat dinamis --}}
            </div>
            <div class="absolute -right-4 -bottom-4 opacity-10">
                <i class="fas fa-parking text-8xl"></i>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4">
            <a href="{{ route('mahasiswa.pilih_kendaraan') }}"
                class="flex items-center justify-between p-6 bg-red-600 rounded-3xl shadow-lg shadow-red-200 group transition-all hover:bg-red-700">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center text-white">
                        <i class="fas fa-qrcode text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Scan QR Parkir</h3>
                        <p class="text-red-100 text-xs font-medium">Masuk atau Keluar Kampus</p>
                    </div>
                </div>
                <i class="fas fa-chevron-right text-white/50 group-hover:translate-x-1 transition"></i>
            </a>

            <div class="grid grid-cols-2 gap-4 mt-2">
                <a href="#"
                    class="p-5 bg-white border border-gray-100 rounded-3xl shadow-sm flex flex-col items-center text-center">
                    <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-3">
                        <i class="fas fa-motorcycle text-sm"></i>
                    </div>
                    <span class="text-[11px] font-bold text-gray-400 uppercase tracking-tight">Kendaraan</span>
                </a>

                <a href="#"
                    class="p-5 bg-white border border-gray-100 rounded-3xl shadow-sm flex flex-col items-center text-center">
                    <div class="w-10 h-10 bg-orange-50 text-orange-600 rounded-xl flex items-center justify-center mb-3">
                        <i class="fas fa-history text-sm"></i>
                    </div>
                    <span class="text-[11px] font-bold text-gray-400 uppercase tracking-tight">Riwayat</span>
                </a>
            </div>
        </div>

        <div class="mt-12 text-center">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="text-gray-400 font-bold text-xs uppercase tracking-widest hover:text-red-600 transition">
                    Logout dari SSO
                </button>
            </form>
        </div>
    </div>
@endsection
