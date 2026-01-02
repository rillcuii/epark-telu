@extends('layouts.mahasiswa')

@section('content')
    <div class="max-w-2xl mx-auto">
        @if (isset($activeParking))
            <div class="text-center bg-white p-8 rounded-[2.5rem] shadow-xl border border-indigo-50">
                <div
                    class="w-24 h-24 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6 animate-pulse">
                    <i class="fas fa-parking text-4xl"></i>
                </div>

                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Sesi Parkir Aktif</h2>
                <p class="text-slate-500 mt-2">Anda telah scan masuk menggunakan kendaraan:</p>

                <div class="mt-8 p-6 bg-slate-50 rounded-3xl border border-slate-100 flex items-center gap-5 text-left">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-slate-400 shadow-sm">
                        <i class="fas fa-motorcycle text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-xl font-black text-slate-900 leading-none">{{ $activeParking->nomor_polisi }}</p>
                        <p class="text-xs font-bold text-indigo-500 uppercase tracking-widest mt-2">
                            {{ $activeParking->model_kendaraan }}</p>
                    </div>
                </div>

                <p class="mt-8 text-sm font-medium text-slate-400 italic">
                    "Silakan scan QR di pos keluar untuk menyelesaikan sesi parkir ini."
                </p>

                <a href="{{ route('mahasiswa.scanner', $activeParking->kendaraan_id) }}"
                    class="mt-8 inline-flex items-center justify-center w-full p-5 bg-indigo-600 text-white rounded-[1.5rem] font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all">
                    <i class="fas fa-qrcode mr-3 text-xl"></i>
                    SCAN UNTUK KELUAR
                </a>
            </div>
        @else
            <div class="mb-8">
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Pilih Kendaraan</h2>
                <p class="text-sm text-slate-500 mt-1 font-medium">Silakan pilih kendaraan untuk memulai sesi parkir baru.
                </p>
            </div>

            <div class="grid gap-4">
                @foreach ($kendaraans as $k)
                    <a href="{{ route('mahasiswa.scanner', $k->id_kendaraan) }}"
                        class="group flex items-center p-5 bg-white border border-slate-100 rounded-[2rem] shadow-sm hover:shadow-xl hover:shadow-indigo-500/10 hover:border-indigo-500 transition-all duration-300">
                        <div
                            class="w-14 h-14 bg-slate-50 group-hover:bg-indigo-50 rounded-2xl flex items-center justify-center text-slate-400 group-hover:text-indigo-600 transition-colors duration-300">
                            <i class="fas fa-motorcycle text-2xl"></i>
                        </div>
                        <div class="ml-5 flex-grow">
                            <p class="text-lg font-black text-slate-900 tracking-tight leading-none">{{ $k->nomor_polisi }}
                            </p>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-2">
                                {{ $k->model_kendaraan }}</p>
                        </div>
                        <i class="fas fa-chevron-right text-slate-300 group-hover:text-indigo-600"></i>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
