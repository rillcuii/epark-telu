@extends('layouts.mahasiswa')

@section('content')
    <div class="max-w-2xl mx-auto pb-10">
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('mahasiswa.keluhan.index') }}"
                class="w-10 h-10 bg-white border border-slate-100 rounded-xl flex items-center justify-center text-slate-400 hover:text-indigo-600 transition shadow-sm">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tight">Buat Keluhan</h2>
                <p class="text-xs font-bold text-slate-400 uppercase mt-1 tracking-widest">Sampaikan kendala layanan parkir
                    Anda</p>
            </div>
        </div>

        @if ($errors->any())
            <div
                class="mb-6 p-4 bg-red-50 text-red-600 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-red-100 flex items-center gap-3">
                <i class="fas fa-exclamation-circle text-sm"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ route('mahasiswa.keluhan.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm space-y-5">
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">
                        Subjek / Judul Keluhan
                    </label>
                    <input type="text" name="judul_keluhan" value="{{ old('judul_keluhan') }}"
                        placeholder="Contoh: Helm Hilang / Parkir Penuh"
                        class="w-full mt-2 p-4 bg-slate-50 border-none rounded-2xl text-sm font-bold focus:ring-2 focus:ring-indigo-500 transition">
                </div>

                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">
                        Isi Deskripsi Keluhan
                    </label>
                    <textarea name="keterangan_keluhan" rows="6" placeholder="Jelaskan detail keluhan Anda secara lengkap..."
                        class="w-full mt-2 p-4 bg-slate-50 border-none rounded-2xl text-sm font-bold focus:ring-2 focus:ring-indigo-500 transition">{{ old('keterangan_keluhan') }}</textarea>
                </div>
            </div>

            <button type="submit"
                class="w-full p-5 bg-indigo-600 text-white rounded-[1.5rem] font-black text-sm shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition uppercase tracking-widest flex items-center justify-center gap-3">
                <i class="fas fa-paper-plane text-xs"></i>
                Kirim Keluhan
            </button>
        </form>

        <div class="mt-8 p-6 bg-slate-50 rounded-[2rem] border border-slate-100">
            <div class="flex items-center gap-3 mb-2">
                <i class="fas fa-shield-alt text-indigo-500 text-xs"></i>
                <span class="text-[10px] font-black text-slate-900 uppercase tracking-widest">Informasi Penting</span>
            </div>
            <p class="text-[10px] text-slate-500 leading-relaxed font-medium">
                Setiap laporan yang masuk akan diverifikasi oleh Admin. Pastikan Anda memberikan deskripsi yang jelas dan
                jujur untuk mempercepat proses tindak lanjut.
            </p>
        </div>
    </div>
@endsection
