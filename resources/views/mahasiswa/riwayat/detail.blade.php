@extends('layouts.mahasiswa')

@section('content')
        <div class="bg-white rounded-[2.5rem] overflow-hidden border border-slate-100 shadow-sm">
            <div class="p-6 bg-slate-900 text-white flex justify-between items-center">
                <a href="{{ route('riwayat.mahasiswa') }}" class="text-slate-400 hover:text-white"><i
                        class="fas fa-arrow-left"></i></a>
                <h3 class="font-black text-sm uppercase tracking-widest">Detail Parkir</h3>
                <div class="w-4"></div>
            </div>

            <div class="p-8">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-black text-slate-900 leading-none">{{ $detail->nomor_polisi }}</h1>
                    <p class="text-sm font-bold text-indigo-500 uppercase mt-2">{{ $detail->model_kendaraan }}</p>
                    <p class="text-[10px] text-slate-400 mt-1 uppercase">Pemilik: {{ $detail->nama_user }}</p>
                </div>

                <div class="space-y-4">
                    <div class="p-4 bg-slate-50 rounded-2xl flex justify-between">
                        <span class="text-[10px] font-black text-slate-400 uppercase">Warna</span>
                        <span class="text-xs font-bold text-slate-800">{{ $detail->warna_kendaraan }}</span>
                    </div>
                    <div class="p-4 bg-slate-50 rounded-2xl flex justify-between">
                        <span class="text-[10px] font-black text-slate-400 uppercase">Waktu Masuk</span>
                        <span
                            class="text-xs font-bold text-slate-800">{{ date('d M Y, H:i', strtotime($detail->waktu_masuk)) }}</span>
                    </div>
                    <div class="p-4 bg-slate-50 rounded-2xl flex justify-between">
                        <span class="text-[10px] font-black text-slate-400 uppercase">Waktu Keluar</span>
                        <span
                            class="text-xs font-bold text-slate-800">{{ $detail->waktu_keluar ? date('d M Y, H:i', strtotime($detail->waktu_keluar)) : 'Belum Keluar' }}</span>
                    </div>
                </div>

                <div class="mt-8 space-y-4">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase mb-2">Foto Kendaraan</p>
                        <img src="{{ asset('storage/' . $detail->url_foto_kendaraan) }}"
                            class="w-full h-48 object-cover rounded-3xl border">
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase mb-2">Foto STNK</p>
                        <img src="{{ asset('storage/' . $detail->url_foto_stnk) }}"
                            class="w-full h-48 object-cover rounded-3xl border">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
