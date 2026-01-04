@extends('layouts.satpam')

@section('content')
    <div class="max-w-2xl mx-auto space-y-6 pb-10">
        <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-slate-100 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div
                    class="w-12 h-12 {{ $data->status == 'masuk' ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600' }} rounded-2xl flex items-center justify-center text-xl">
                    <i class="fas {{ $data->status == 'masuk' ? 'fa-sign-in-alt' : 'fa-sign-out-alt' }}"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Aktivitas Parkir</p>
                    <h2 class="text-sm font-black text-slate-900 uppercase">Sesi: {{ $data->status }}</h2>
                </div>
            </div>
            <div class="text-right">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Waktu Scan</p>
                <p class="text-sm font-black text-slate-900">{{ date('H:i:s', strtotime($data->waktu_masuk)) }} WIB</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 bg-slate-900 text-white">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-1">Identitas Mahasiswa</p>
                    <h3 class="text-lg font-black tracking-tight">{{ $data->nama_user }}</h3>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 bg-indigo-600 text-white">
                    <p class="text-[10px] font-bold text-indigo-200 uppercase tracking-[0.2em] mb-1">Spesifikasi Kendaraan
                    </p>
                    <h3 class="text-lg font-black tracking-tight">{{ $data->nomor_polisi }}</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase">Model Kendaraan</p>
                        <p class="text-sm font-bold text-slate-800">{{ $data->model_kendaraan }}</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase">Warna Kendaraan</p>
                        <div class="flex items-center gap-2 mt-1">
                            <p class="text-sm font-bold text-slate-800">{{ $data->warna_kendaraan ?? 'Tidak dicantumkan' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($data->url_foto_kendaraan || $data->url_foto_stnk)
            <div class="bg-white rounded-[2.5rem] p-6 shadow-sm border border-slate-100">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 text-center">Lampiran Fisik
                </p>
                <div class="grid grid-cols-2 gap-4">
                    @if ($data->url_foto_kendaraan)
                        <div class="space-y-2">
                            <p class="text-[9px] font-black text-slate-400 uppercase text-center">Foto Kendaraan</p>
                            <img src="{{ asset('storage/' . $data->url_foto_kendaraan) }}"
                                class="w-full h-32 object-cover rounded-2xl border">
                        </div>
                    @endif
                    @if ($data->url_foto_stnk)
                        <div class="space-y-2">
                            <p class="text-[9px] font-black text-slate-400 uppercase text-center">Foto STNK</p>
                            <img src="{{ asset('storage/' . $data->url_foto_stnk) }}"
                                class="w-full h-32 object-cover rounded-2xl border">
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <div class="flex gap-4">
            <a href="{{ route('satpam.dashboard') }}"
                class="flex-1 py-4 bg-white text-slate-600 text-center rounded-2xl font-bold text-xs border border-slate-200 hover:bg-slate-50 transition uppercase tracking-widest">
                Kembali
            </a>
            <button onclick="window.location.href='{{ route('satpam.dashboard') }}'"
                class="flex-[2] py-4 bg-emerald-600 text-white text-center rounded-2xl font-bold text-xs shadow-lg shadow-emerald-100 hover:bg-emerald-700 transition uppercase tracking-widest">
                Konfirmasi Aman
            </button>
        </div>
    </div>
@endsection
