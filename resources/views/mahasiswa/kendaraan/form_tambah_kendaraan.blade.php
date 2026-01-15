@extends('layouts.mahasiswa')

@section('content')
    <div class="max-w-2xl mx-auto pb-10">
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('mahasiswa.kendaraan.index') }}"
                class="w-10 h-10 bg-white border border-slate-100 rounded-xl flex items-center justify-center text-slate-400 hover:text-indigo-600 transition">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Daftar Kendaraan</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Input data unit baru</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-2xl">
                @foreach ($errors->all() as $error)
                    <p class="text-red-600 text-[10px] font-black uppercase tracking-widest flex items-center gap-2">
                        <i class="fas fa-exclamation-circle"></i> {{ $error }}
                    </p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('mahasiswa.kendaraan.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm space-y-5">
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nomor Polisi
                        (Plat)</label>
                    <input type="text" name="nomor_polisi" placeholder="Contoh: B 1234 ABC"
                        value="{{ old('nomor_polisi') }}"
                        class="w-full mt-2 p-4 bg-slate-50 border-none rounded-2xl text-sm font-bold focus:ring-2 focus:ring-indigo-500 transition uppercase">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Model
                            Motor</label>
                        <input type="text" name="model_kendaraan" placeholder="Vario 150"
                            value="{{ old('model_kendaraan') }}"
                            class="w-full mt-2 p-4 bg-slate-50 border-none rounded-2xl text-sm font-bold focus:ring-2 focus:ring-indigo-500 transition">
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Warna</label>
                        <input type="text" name="warna_kendaraan" placeholder="Hitam"
                            value="{{ old('warna_kendaraan') }}"
                            class="w-full mt-2 p-4 bg-slate-50 border-none rounded-2xl text-sm font-bold focus:ring-2 focus:ring-indigo-500 transition">
                    </div>
                </div>

                <hr class="border-slate-50 my-2">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Foto
                            Kendaraan</label>
                        <input type="file" name="url_foto_kendaraan"
                            class="mt-2 block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Foto
                            STNK</label>
                        <input type="file" name="url_foto_stnk"
                            class="mt-2 block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>
                </div>
            </div>

            <button type="submit"
                class="w-full p-5 bg-indigo-600 text-white rounded-[1.5rem] font-black text-sm shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition uppercase tracking-widest">
                Simpan Kendaraan
            </button>
        </form>
    </div>
@endsection
