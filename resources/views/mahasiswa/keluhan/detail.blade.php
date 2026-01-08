@extends('layouts.mahasiswa')

@section('content')
    <div class="max-w-2xl mx-auto pb-10">
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('mahasiswa.keluhan.index') }}"
                class="w-10 h-10 bg-white border border-slate-100 rounded-xl flex items-center justify-center text-slate-400 hover:text-indigo-600 transition shadow-sm">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Detail Keluhan</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">ID:
                    {{ substr($keluhan->id_keluhan, 0, 8) }}...</p>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
            <div
                class="px-8 py-4 flex items-center justify-between 
            @if ($keluhan->status_keluhan == 'belum_ditangani') bg-slate-50 
            @elseif($keluhan->status_keluhan == 'sedang_ditangani') bg-amber-50 
            @else bg-emerald-50 @endif">

                <div class="flex items-center gap-2">
                    <div
                        class="w-2 h-2 rounded-full 
                    @if ($keluhan->status_keluhan == 'belum_ditangani') bg-slate-400 
                    @elseif($keluhan->status_keluhan == 'sedang_ditangani') bg-amber-500 
                    @else bg-emerald-500 @endif animate-pulse">
                    </div>
                    <span
                        class="text-[10px] font-black uppercase tracking-widest 
                    @if ($keluhan->status_keluhan == 'belum_ditangani') text-slate-500 
                    @elseif($keluhan->status_keluhan == 'sedang_ditangani') text-amber-700 
                    @else text-emerald-700 @endif">
                        {{ str_replace('_', ' ', $keluhan->status_keluhan) }}
                    </span>
                </div>
                <span class="text-[10px] font-bold text-slate-400 uppercase">
                    Dikirim: {{ $keluhan->created_at->format('d M Y, H:i') }}
                </span>
            </div>

            <div class="p-8">
                <h1 class="text-xl font-black text-slate-900 leading-tight mb-4">
                    {{ $keluhan->judul_keluhan }}
                </h1>

                <div class="prose prose-slate">
                    <p class="text-sm text-slate-600 leading-relaxed italic">
                        "{{ $keluhan->keterangan_keluhan }}"
                    </p>
                </div>

                <hr class="my-8 border-slate-50">

                <div class="space-y-4">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Tanggapan Admin</h4>

                    @if ($keluhan->status_keluhan == 'belum_ditangani')
                        <div class="p-5 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                            <p class="text-xs text-slate-400 font-medium italic">
                                Belum ada tanggapan. Keluhan Anda sedang dalam antrean verifikasi admin.
                            </p>
                        </div>
                    @else
                        <div class="p-5 bg-indigo-50 rounded-2xl border border-indigo-100">
                            <p class="text-xs text-indigo-900 leading-relaxed">
                                Admin sedang menindaklanjuti laporan Anda. Harap pantau halaman ini secara berkala.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-6 p-6 bg-amber-50 rounded-[2rem] border border-amber-100 flex items-start gap-4">
            <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center text-amber-600 shrink-0">
                <i class="fas fa-info-circle"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-amber-800 uppercase tracking-wide">Pemberitahuan</p>
                <p class="text-[10px] text-amber-700 leading-relaxed mt-1">
                    Proses penanganan keluhan biasanya memakan waktu 1-3 hari kerja tergantung pada tingkat kerumitan
                    masalah.
                </p>
            </div>
        </div>
    </div>
@endsection
