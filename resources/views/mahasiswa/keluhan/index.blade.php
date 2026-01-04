@extends('layouts.mahasiswa')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-black text-slate-900 uppercase">Keluhan</h2>
            <a href="{{ route('mahasiswa.keluhan.create') }}"
                class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl font-bold text-xs uppercase tracking-widest shadow-lg shadow-indigo-100">
                Tambah Keluhan
            </a>
        </div>

        <form action="{{ route('mahasiswa.keluhan.index') }}" method="GET" class="mb-8 space-y-3">
            <div class="relative">
                <input type="text" name="search" placeholder="Cari judul atau isi keluhan..."
                    value="{{ request('search') }}"
                    class="w-full p-4 pl-12 bg-white border-none rounded-2xl shadow-sm text-sm focus:ring-2 focus:ring-indigo-500">
                <i class="fas fa-search absolute left-5 top-4.5 mt-4 text-slate-300"></i>
            </div>
            <div class="flex gap-2 overflow-x-auto pb-2">
                @foreach (['Semua', 'belum_ditangani', 'sedang_ditangani', 'sudah_ditangani'] as $status)
                    <button type="submit" name="status" value="{{ $status }}"
                        class="px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest transition
                {{ request('status', 'Semua') == $status ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-100' : 'bg-white text-slate-400 border border-slate-100' }}">

                        {{-- Mengganti underscore dengan spasi untuk tampilan --}}
                        {{ str_replace('_', ' ', $status) }}
                    </button>
                @endforeach
            </div>
        </form>

        <div class="space-y-4">
            @forelse($keluhans as $k)
                <a href="{{ route('mahasiswa.keluhan.detail', $k->id_keluhan) }}"
                    class="block bg-white p-6 rounded-[2rem] border border-slate-100 mb-4">
                    <div class="flex justify-between items-start mb-3">
                        <span class="px-3 py-1 bg-slate-100 text-slate-500 rounded-lg text-[9px] font-black uppercase">
                            {{ str_replace('_', ' ', $k->status_keluhan) }}
                        </span>
                    </div>
                    <h3 class="text-lg font-black text-slate-800">{{ $k->judul_keluhan }}</h3>
                    <p class="text-xs text-slate-500 mt-2">{{ Str::limit($k->keterangan_keluhan, 100) }}</p>
                </a>
            @empty
                <div class="text-center py-20">
                    <p class="text-slate-400 font-bold uppercase">Data keluhan Kosong</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
