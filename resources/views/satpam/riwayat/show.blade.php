@extends('layouts.satpam')

@section('content')
    <div class="max-w-5xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <a href="{{ route('satpam.riwayat_parkir') }}"
                class="group flex items-center text-sm font-bold text-gray-500 hover:text-red-600 transition">
                <div
                    class="w-8 h-8 bg-white border border-gray-100 rounded-lg flex items-center justify-center mr-3 group-hover:border-red-100 group-hover:bg-red-50 transition">
                    <i class="fas fa-chevron-left text-[10px]"></i>
                </div>
                KEMBALI KE RIWAYAT
            </a>
            <div class="text-right">
                <span
                    class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest {{ $parkir->status == 'masuk' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                    Status: {{ $parkir->status }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                    <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6">Informasi Mahasiswa</h3>
                    <div class="flex items-center gap-4 mb-6">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($parkir->user->nama_user) }}&background=F1F5F9&color=64748b"
                            class="w-12 h-12 rounded-2xl" alt="">
                        <div>
                            <p class="text-sm font-bold text-gray-900 leading-none">{{ $parkir->user->nama_user }}</p>
                            <p class="text-[10px] text-gray-400 font-medium mt-1">
                                {{ $parkir->user->nim ?? 'NIM tidak tersedia' }}</p>
                        </div>
                    </div>
                    <div class="space-y-4 pt-4 border-t border-gray-50">
                        <div>
                            <p class="text-[9px] text-gray-400 font-bold uppercase">Waktu Masuk</p>
                            <p class="text-xs font-semibold text-gray-700">
                                {{ \Carbon\Carbon::parse($parkir->waktu_masuk)->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] text-gray-400 font-bold uppercase">Waktu Keluar</p>
                            <p class="text-xs font-semibold text-gray-700">
                                {{ $parkir->waktu_keluar ? \Carbon\Carbon::parse($parkir->waktu_keluar)->format('d M Y, H:i') : '-' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-900 p-6 rounded-3xl text-white">
                    <p class="text-[9px] text-slate-500 font-bold uppercase mb-2">ID Transaksi Parkir</p>
                    <code class="text-[10px] break-all text-slate-300 font-mono">{{ $parkir->id_parkir }}</code>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-50 bg-gray-50/30">
                        <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Detail Kendaraan</h3>
                    </div>
                    <div class="p-6 grid grid-cols-2 gap-6">
                        <div>
                            <p class="text-[9px] text-gray-400 font-bold uppercase">Nomor Polisi</p>
                            <p class="text-lg font-black text-gray-900 tracking-tight">
                                {{ $parkir->kendaraan->nomor_polisi }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] text-gray-400 font-bold uppercase">Model / Tipe</p>
                            <p class="text-sm font-bold text-gray-800">{{ $parkir->kendaraan->model_kendaraan }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] text-gray-400 font-bold uppercase">Warna</p>
                            <p class="text-sm font-bold text-gray-800">{{ $parkir->kendaraan->warna_kendaraan }}</p>
                        </div>
                    </div>

                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4 border-t border-gray-50">
                        <div>
                            <p class="text-[9px] text-gray-400 font-bold uppercase mb-3">Dokumentasi Kendaraan</p>
                            <div
                                class="relative aspect-video rounded-2xl overflow-hidden border border-gray-100 bg-gray-50">
                                @if ($parkir->kendaraan->url_foto_kendaraan)
                                    <img src="{{ asset('storage/' . $parkir->kendaraan->url_foto_kendaraan) }}"
                                        class="w-full h-full object-cover" alt="Foto Kendaraan">
                                @else
                                    <div class="flex items-center justify-center h-full text-gray-300">
                                        <i class="fas fa-image text-3xl"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div>
                            <p class="text-[9px] text-gray-400 font-bold uppercase mb-3">Dokumentasi STNK</p>
                            <div
                                class="relative aspect-video rounded-2xl overflow-hidden border border-gray-100 bg-gray-50">
                                @if ($parkir->kendaraan->url_foto_stnk)
                                    <img src="{{ asset('storage/' . $parkir->kendaraan->url_foto_stnk) }}"
                                        class="w-full h-full object-cover" alt="Foto STNK">
                                @else
                                    <div class="flex items-center justify-center h-full text-gray-300">
                                        <i class="fas fa-id-card text-3xl"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
