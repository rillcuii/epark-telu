@extends('layouts.mahasiswa')

@section('content')
    <div class="max-w-2xl mx-auto pb-10">
        <div class="mb-8">
            <h2 class="text-2xl font-black text-slate-900">Riwayat Parkir</h2>
            <p class="text-sm text-slate-500">Cari dan lihat riwayat parkir Anda.</p>
        </div>

        <form action="{{ route('riwayat.mahasiswa') }}" method="GET" class="mb-8 flex gap-2">
            <div class="relative flex-grow">
                <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                    class="w-full p-4 bg-white border border-slate-200 rounded-2xl text-sm font-bold focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
            </div>
            <button type="submit"
                class="px-6 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 transition">
                <i class="fas fa-search"></i>
            </button>
            @if (request('tanggal'))
                <a href="{{ route('riwayat.mahasiswa') }}"
                    class="px-6 bg-slate-100 text-slate-600 rounded-2xl font-bold flex items-center justify-center">
                    <i class="fas fa-times"></i>
                </a>
            @endif
        </form>

        <div class="space-y-4">
            @forelse($history as $h)
                <a href="{{ route('riwayat.detail.mahasiswa', $h->id_parkir) }}"
                    class="block bg-white p-5 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400">
                                <i class="fas fa-motorcycle"></i>
                            </div>
                            <div>
                                <p class="text-sm font-black text-slate-900">{{ $h->nomor_polisi }}</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                    {{ $h->model_kendaraan }}</p>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-slate-300"></i>
                    </div>
                    <div class="flex justify-between items-center text-[10px] font-bold text-slate-500 uppercase">
                        <span><i class="fas fa-sign-in-alt mr-1"></i> {{ date('H:i', strtotime($h->waktu_masuk)) }}</span>
                        <span><i class="fas fa-sign-out-alt mr-1"></i>
                            {{ $h->waktu_keluar ? date('H:i', strtotime($h->waktu_keluar)) : 'Aktif' }}</span>
                    </div>
                </a>
            @empty
                <div class="text-center py-20 bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-200">
                    <div class="text-4xl text-slate-300 mb-4"><i class="fas fa-folder-open"></i></div>
                    <p class="text-sm font-bold text-slate-400 italic">Data riwayat parkir tidak ditemukan.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
