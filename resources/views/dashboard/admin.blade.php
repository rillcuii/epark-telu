@extends('layouts.admin')

@section('content')
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Selamat Datang, Admin! 👋</h1>
        <p class="text-gray-600">Berikut adalah ringkasan sistem E-Park hari ini.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <div
            class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div
                    class="p-3 bg-blue-500 rounded-xl shadow-lg shadow-blue-200 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-user-shield text-white text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Total Satpam</p>
                    <p class="text-2xl font-black text-gray-900 mt-1">{{ $countSatpam }}</p>
                </div>
            </div>
            <div class="flex items-center text-[10px] text-blue-600 font-bold uppercase tracking-tighter">
                <span class="bg-blue-50 px-2 py-0.5 rounded-full italic">Petugas Aktif</span>
            </div>
        </div>

        <div
            class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div
                    class="p-3 bg-red-500 rounded-xl shadow-lg shadow-red-200 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-exclamation-circle text-white text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Keluhan Baru</p>
                    <p class="text-2xl font-black text-gray-900 mt-1">{{ $countKeluhan }}</p>
                </div>
            </div>
            <div class="flex items-center text-[10px] text-red-600 font-bold uppercase tracking-tighter">
                <span class="bg-red-50 px-2 py-0.5 rounded-full italic">Perlu Respon</span>
            </div>
        </div>

        <div
            class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div
                    class="p-3 bg-emerald-500 rounded-xl shadow-lg shadow-emerald-200 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-qrcode text-white text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Scan Hari Ini</p>
                    <p class="text-2xl font-black text-gray-900 mt-1">148</p>
                </div>
            </div>
            <div class="flex items-center text-[10px] text-emerald-600 font-bold uppercase tracking-tighter">
                <i class="fas fa-arrow-up mr-1"></i> +12% Dari Kemarin
            </div>
        </div>

    </div>

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 mb-8">
        <div class="flex items-center mb-6">
            <div class="p-2 bg-yellow-100 rounded-lg mr-3">
                <i class="fas fa-bolt text-yellow-600 text-lg"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900">Aksi Cepat Admin</h3>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <a href="{{ route('satpam.create') }}"
                class="group p-6 border-2 border-dashed border-gray-100 rounded-2xl hover:border-blue-500 hover:bg-blue-50 transition-all duration-300 text-center">
                <div
                    class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-user-plus text-blue-600 text-xl"></i>
                </div>
                <p class="text-sm font-bold text-gray-700 group-hover:text-blue-600">Tambah Satpam</p>
                <p class="text-[10px] text-gray-400 mt-1 italic">Registrasi petugas baru</p>
            </a>

            <a href="{{ route('keluhan.index') }}"
                class="group p-6 border-2 border-dashed border-gray-100 rounded-2xl hover:border-red-500 hover:bg-red-50 transition-all duration-300 text-center">
                <div
                    class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-clipboard-list text-red-600 text-xl"></i>
                </div>
                <p class="text-sm font-bold text-gray-700 group-hover:text-red-600">Cek Keluhan</p>
                <p class="text-[10px] text-gray-400 mt-1 italic">Respon laporan mahasiswa</p>
            </a>

            <a href="{{ route('satpam.index') }}"
                class="group p-6 border-2 border-dashed border-gray-100 rounded-2xl hover:border-emerald-500 hover:bg-emerald-50 transition-all duration-300 text-center">
                <div
                    class="w-14 h-14 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-users-cog text-emerald-600 text-xl"></i>
                </div>
                <p class="text-sm font-bold text-gray-700 group-hover:text-emerald-600">Data Satpam</p>
                <p class="text-[10px] text-gray-400 mt-1 italic">Kelola akun petugas</p>
            </a>
        </div>
    </div>

    <!-- Recent Activity Section (Optional) -->
    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <div class="p-2 bg-indigo-100 rounded-lg mr-3">
                    <i class="fas fa-history text-indigo-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Aktivitas Terbaru</h3>
            </div>
            <a href="{{ route('keluhan.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Lihat
                Semua</a>
        </div>

        <div class="space-y-4">
            @if ($lastSatpam)
                <div class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-user-plus text-blue-600"></i>
                    </div>
                    <div class="flex-grow">
                        <p class="text-sm font-semibold text-gray-900">Satpam baru ditambahkan</p>
                        <p class="text-xs text-gray-500">{{ $lastSatpam->nama_user }} -
                            {{ $lastSatpam->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            @endif

            @if ($lastKeluhanMasuk)
                <div class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-exclamation-circle text-red-600"></i>
                    </div>
                    <div class="flex-grow">
                        <p class="text-sm font-semibold text-gray-900">Keluhan baru masuk</p>
                        <p class="text-xs text-gray-500">{{ $lastKeluhanMasuk->judul_keluhan }} -
                            {{ $lastKeluhanMasuk->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            @endif

            @if ($lastKeluhanSelesai)
                <div class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                    <div class="flex-grow">
                        <p class="text-sm font-semibold text-gray-900">Keluhan diselesaikan</p>
                        <p class="text-xs text-gray-500">{{ $lastKeluhanSelesai->judul_keluhan }} -
                            {{ $lastKeluhanSelesai->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
            @endif

            @if (!$lastSatpam && !$lastKeluhanMasuk && !$lastKeluhanSelesai)
                <p class="text-center text-gray-400 text-sm italic">Belum ada aktivitas terbaru.</p>
            @endif
        </div>
    </div>
@endsection
