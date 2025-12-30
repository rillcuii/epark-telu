@extends('layouts.satpam_web')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('satpam.dashboard') }}" class="text-sm font-bold text-gray-500 hover:text-red-600 transition">
                <i class="fas fa-arrow-left mr-2"></i> KEMBALI
            </a>
            <span class="bg-red-600 text-white px-4 py-1 rounded-full text-[10px] font-black uppercase">Mode
                Verifikasi</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-6">
                <div class="bg-white p-4 rounded-3xl border border-gray-100 shadow-sm">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Foto Kendaraan</p>
                    <img src="{{ asset('storage/' . $parkir->kendaraan->foto_kendaraan) }}"
                        class="w-full h-56 object-cover rounded-2xl border border-gray-100" alt="Foto Kendaraan">
                </div>
                <div class="bg-white p-4 rounded-3xl border border-gray-100 shadow-sm">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Foto STNK</p>
                    <img src="{{ asset('storage/' . $parkir->kendaraan->foto_stnk) }}"
                        class="w-full h-56 object-cover rounded-2xl border border-gray-100" alt="Foto STNK">
                </div>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm flex flex-col justify-between">
                <div class="space-y-6">
                    <div>
                        <h2 class="text-3xl font-black text-gray-900 leading-tight">{{ $parkir->kendaraan->plat_nomor }}
                        </h2>
                        <p class="text-sm font-bold text-red-600 uppercase">{{ $parkir->kendaraan->model_kendaraan }}</p>
                    </div>

                    <div class="grid grid-cols-1 gap-4 py-6 border-y border-gray-50">
                        <div>
                            <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Nama Mahasiswa</p>
                            <p class="text-sm font-bold text-gray-800">{{ $parkir->user->nama_user }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">NIM</p>
                            <p class="text-sm font-bold text-gray-800">{{ $parkir->user->nim ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Pemilik STNK</p>
                            <p class="text-sm font-bold text-gray-800">{{ $parkir->kendaraan->nama_pemilik }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Warna Kendaraan</p>
                            <p class="text-sm font-bold text-gray-800">{{ $parkir->kendaraan->warna_kendaraan }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6">
                    <button onclick="window.print()"
                        class="w-full bg-emerald-600 text-white py-4 rounded-2xl font-black text-sm hover:bg-emerald-700 transition shadow-lg shadow-emerald-100 uppercase tracking-widest">
                        VERIFIKASI BERHASIL
                    </button>
                    <p class="text-center text-[10px] text-gray-400 mt-4 italic italic">Data dicocokkan pada
                        {{ date('H:i:s d/m/Y') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
