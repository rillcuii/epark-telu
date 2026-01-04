@extends('layouts.satpam')

@section('content')
    <div class="min-h-screen bg-[#F8F9FA] relative">
        <div class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-[430px] z-50">
            <div class="bg-figmaRed h-32 flex items-center px-8 rounded-b-[40px] shadow-lg">
                <a href="{{ route('satpam.dashboard') }}" class="text-white text-2xl mr-6 transition active:scale-90">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-white text-xl font-bold tracking-tight">Riwayat Parkir</h1>
            </div>
        </div>

        <div class="px-6 pt-24 pb-24">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-gray-900">Daftar kendaraan</h2>

                <form action="{{ route('satpam.riwayat_parkir') }}" method="GET" class="relative">
                    <input type="date" name="tanggal" onchange="this.form.submit()" value="{{ request('tanggal') }}"
                        class="absolute inset-0 opacity-0 cursor-pointer">
                    <div class="flex items-center gap-2 text-gray-500 font-bold text-xs uppercase tracking-widest">
                        <i class="fas fa-filter text-sm"></i>
                        <span>Filter</span>
                    </div>
                </form>
            </div>

            <div class="space-y-6">
                @php $currentDate = null; @endphp

                @forelse($riwayats as $r)
                    {{-- Logika Grouping Tanggal --}}
                    @php
                        $dateRow = \Carbon\Carbon::parse($r->waktu_masuk)->translatedFormat('l, d F Y');
                    @endphp

                    @if ($currentDate !== $dateRow)
                        <h3 class="text-sm font-bold text-gray-500 mt-6 mb-2 ml-1 lowercase first-letter:uppercase">
                            {{ $dateRow }}
                        </h3>
                        @php $currentDate = $dateRow; @endphp
                    @endif

                    <div
                        class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex items-center gap-4 relative overflow-hidden">
                        {{-- Indikator Warna Status --}}
                        <div
                            class="absolute left-0 top-0 bottom-0 w-1.5 
                        @if ($r->status == 'masuk') bg-blue-500 
                        @elseif($loop->index % 3 == 1) bg-purple-500 
                        @else bg-yellow-400 @endif">
                        </div>

                        <div
                            class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center shrink-0 border border-gray-100">
                            <i class="fas fa-user text-gray-300 text-xl"></i>
                        </div>

                        <div class="flex-1 min-w-0">
                            <h3 class="text-sm font-black text-gray-900 leading-tight">{{ $r->kendaraan->plat_nomor }}</h3>
                            <p class="text-[10px] text-gray-400 font-bold uppercase truncate">
                                {{ $r->kendaraan->model_kendaraan }}
                            </p>
                        </div>

                        <div class="text-[9px] font-bold text-gray-500 space-y-1 pr-10 border-r border-gray-50">
                            <div class="flex justify-between gap-2">
                                <span>Waktu Masuk</span>
                                <span class="text-gray-900">:
                                    {{ \Carbon\Carbon::parse($r->waktu_masuk)->format('H:i') }}</span>
                            </div>
                            <div class="flex justify-between gap-2">
                                <span>Waktu Keluar</span>
                                <span class="text-gray-900">:
                                    {{ $r->waktu_keluar ? \Carbon\Carbon::parse($r->waktu_keluar)->format('H:i') : '-' }}</span>
                            </div>
                        </div>

                        <a href="{{ route('satpam.riwayat.detail', $r->id_parkir) }}"
                            class="absolute right-3 top-1/2 -translate-y-1/2 w-8 h-8 flex items-center justify-center bg-gray-50 rounded-lg text-gray-400 hover:bg-red-50 hover:text-red-600 transition-colors border border-gray-100">
                            <i class="fas fa-list-ul text-xs"></i>
                        </a>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-20 opacity-40">
                        <div class="relative mb-4">
                            <i class="fas fa-folder-open text-7xl text-gray-300"></i>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-10 h-1 bg-gray-400 rotate-45 rounded-full"></div>
                            </div>
                        </div>
                        <p class="text-xs font-bold text-gray-400 italic">"Data riwayat parkir tidak ditemukan"</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $riwayats->links() }}
            </div>
        </div>

        <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[430px] flex justify-center z-50">
            <div class="relative w-full flex justify-center">
                <div class="absolute bottom-0 w-full h-10 bg-white shadow-[0_-5px_15px_rgba(0,0,0,0.03)]"
                    style="clip-path: polygon(0 0, 38% 0, 42% 40%, 50% 60%, 58% 40%, 62% 0, 100% 0, 100% 100%, 0 100%);">
                </div>
                <div class="relative -top-6 bg-white p-2 rounded-full shadow-lg">
                    <div
                        class="w-14 h-14 bg-white rounded-full flex items-center justify-center border border-gray-100 shadow-inner">
                        <i class="fas fa-history text-2xl text-gray-800"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
