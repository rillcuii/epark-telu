@extends('layouts.mahasiswa')

@section('content')
    <div class="max-w-2xl mx-auto pb-10">
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('mahasiswa.kendaraan.index') }}"
                class="w-10 h-10 bg-white border border-slate-100 rounded-xl flex items-center justify-center text-slate-400 hover:text-indigo-600 transition">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Edit Kendaraan</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Perbarui informasi kendaraan Anda
                </p>
            </div>
        </div>

        <form action="{{ route('mahasiswa.kendaraan.update', $kendaraan->id_kendaraan) }}" method="POST"
            enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm space-y-5">
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nomor Polisi
                        (Plat)</label>
                    <input type="text" name="nomor_polisi" value="{{ $kendaraan->nomor_polisi }}"
                        class="w-full mt-2 p-4 bg-slate-50 border-none rounded-2xl text-sm font-bold focus:ring-2 focus:ring-indigo-500 transition uppercase">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Model
                            Motor</label>
                        <input type="text" name="model_kendaraan" value="{{ $kendaraan->model_kendaraan }}"
                            class="w-full mt-2 p-4 bg-slate-50 border-none rounded-2xl text-sm font-bold focus:ring-2 focus:ring-indigo-500 transition">
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Warna</label>
                        <input type="text" name="warna_kendaraan" value="{{ $kendaraan->warna_kendaraan }}"
                            class="w-full mt-2 p-4 bg-slate-50 border-none rounded-2xl text-sm font-bold focus:ring-2 focus:ring-indigo-500 transition">
                    </div>
                </div>

                <hr class="border-slate-50 my-2">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Ganti Foto
                            Motor</label>
                        <input type="file" name="url_foto_kendaraan" class="mt-2 block w-full text-[10px]">
                        @if ($kendaraan->url_foto_kendaraan)
                            <img src="{{ asset('storage/' . $kendaraan->url_foto_kendaraan) }}"
                                class="mt-2 w-20 h-20 object-cover rounded-xl border border-slate-100">
                        @endif
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Ganti Foto
                            STNK</label>
                        <input type="file" name="url_foto_stnk" class="mt-2 block w-full text-[10px]">
                        @if ($kendaraan->url_foto_stnk)
                            <img src="{{ asset('storage/' . $kendaraan->url_foto_stnk) }}"
                                class="mt-2 w-20 h-20 object-cover rounded-xl border border-slate-100">
                        @endif
                    </div>
                </div>
            </div>

            <button type="submit"
                class="w-full p-5 bg-slate-900 text-white rounded-[1.5rem] font-black text-sm shadow-xl shadow-slate-100 hover:bg-black transition uppercase tracking-widest">
                Simpan Perubahan
            </button>
        </form>
    </div>
@endsection
