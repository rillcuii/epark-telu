@extends('layouts.mahasiswa')

@section('content')
    <div class="w-full">
        
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-black text-gray-900">Halo, {{ auth()->user()->nama_user }}! 👋</h1>
                <p class="text-sm text-gray-500 font-medium mt-1">NIM: <span class="bg-gray-200 px-2 py-0.5 rounded text-gray-700">{{ auth()->user()->nim }}</span></p>
            </div>
            
            <div class="hidden md:block text-right">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Hari ini</p>
                <p class="text-lg font-bold text-gray-700">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-gray-900 text-white p-6 rounded-3xl shadow-xl relative overflow-hidden flex flex-col justify-between h-48 md:h-auto">
                <div class="relative z-10">
                    <p class="text-xs opacity-60 uppercase font-bold tracking-widest mb-2">Status Parkir</p>
                    <h2 class="text-2xl font-bold flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-gray-500"></span>
                        Di Luar Area
                    </h2> 
                </div>
                
                <div class="relative z-10 mt-4">
                    <p class="text-xs text-gray-400">Belum ada aktivitas parkir aktif.</p>
                </div>

                <div class="absolute -right-6 -bottom-6 opacity-10 rotate-12">
                    <i class="fas fa-parking text-9xl"></i>
                </div>
            </div>

            <a href="{{ route('mahasiswa.pilih_kendaraan') }}"
               class="group relative p-6 bg-red-600 rounded-3xl shadow-lg shadow-red-200 overflow-hidden flex flex-col justify-between h-48 md:h-auto hover:bg-red-700 transition-all duration-300">
                
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center text-white mb-4 backdrop-blur-sm">
                        <i class="fas fa-qrcode text-2xl group-hover:scale-110 transition-transform"></i>
                    </div>
                    <h3 class="text-white font-bold text-xl">Scan QR Parkir</h3>
                    <p class="text-red-100 text-xs font-medium mt-1">Masuk atau Keluar Kampus</p>
                </div>

                <div class="absolute right-4 bottom-4 opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all duration-300">
                    <div class="w-10 h-10 bg-white text-red-600 rounded-full flex items-center justify-center shadow-lg">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>

                <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full blur-2xl"></div>
            </a>

            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('mahasiswa.kendaraan.index') }}"
                   class="p-4 bg-white border border-gray-100 rounded-3xl shadow-sm hover:shadow-md transition flex flex-col items-center justify-center text-center gap-3 h-full">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-motorcycle text-xl"></i>
                    </div>
                    <span class="text-xs font-bold text-gray-600 uppercase tracking-tight">Kendaraan</span>
                </a>

                <a href="{{ route('riwayat.mahasiswa') }}"
                   class="p-4 bg-white border border-gray-100 rounded-3xl shadow-sm hover:shadow-md transition flex flex-col items-center justify-center text-center gap-3 h-full">
                    <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-history text-xl"></i>
                    </div>
                    <span class="text-xs font-bold text-gray-600 uppercase tracking-tight">Riwayat</span>
                </a>
            </div>

        </div>
        
        <div class="mt-8 p-6 bg-indigo-50 border border-indigo-100 rounded-2xl flex items-start gap-4">
            <div class="text-indigo-500 mt-1">
                <i class="fas fa-info-circle text-xl"></i>
            </div>
            <div>
                <h4 class="font-bold text-indigo-900 text-sm">Informasi Jam Operasional</h4>
                <p class="text-xs text-indigo-700 mt-1 leading-relaxed">
                    Parkir mahasiswa dibuka mulai pukul <strong>06:00 - 22:00 WIB</strong>. Pastikan checkout sebelum jam operasional berakhir untuk menghindari denda inap.
                </p>
            </div>
        </div>

    </div>
@endsection