@extends('layouts.admin')

@section('content')
    {{-- Header Fixed (Sama dengan logic Satpam) --}}
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-[430px] z-50">
        <div class="bg-figmaRed h-32 flex items-center px-8 rounded-b-[40px] shadow-lg">
            <a href="{{ route('admin.dashboard') }}" class="text-white text-2xl mr-6">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-white text-xl font-bold tracking-tight ">Laporan Keluhan</h1>
        </div>
    </div>
    
    {{-- Modal Sukses (Hanya muncul jika ada session success) --}}
    @if (session('success'))
        <div id="successModal"
            class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-black/40 backdrop-blur-sm">
            <div class="bg-white w-full max-w-[340px] rounded-[40px] p-10 text-center shadow-2xl transform transition-all">
                {{-- Icon Checkmark sesuai Figma --}}
                <div
                    class="w-24 h-24 bg-green-50 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6 text-5xl">
                    <i class="fas fa-check"></i>
                </div>

                <h4 class="text-2xl font-bold text-gray-900 mb-3">Status Disimpan!</h4>
                <p class="text-sm text-gray-500 mb-8 leading-relaxed">
                    {{ session('success') }}
                </p>

                <button onclick="document.getElementById('successModal').remove()"
                    class="w-full py-4 bg-figmaRed text-white rounded-2xl font-bold text-base shadow-lg shadow-figmaRed/30 transition active:scale-95">
                    Oke, Mengerti
                </button>
            </div>
        </div>
    @endif
    <div class="pt-2 px-2">

        {{-- Search Bar --}}
        <div class="px-4 mb-6">
            <form action="{{ route('keluhan.index') }}" method="GET">
                <div class="relative shadow-xl shadow-black/5 rounded-full overflow-hidden">
                    <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari keluhan..."
                        class="w-full pl-14 pr-6 py-4 bg-white border-none focus:ring-0 text-gray-700 placeholder-gray-300">
                </div>

                {{-- Filter Tabs --}}
                <div class="flex gap-2 mt-6 overflow-x-auto pb-2 scrollbar-hide">
                    @php
                        $currentStatus = request('status', 'Semua');
                        $statuses = [
                            'Semua' => 'Semua',
                            'belum_ditangani' => 'Belum',
                            'sedang_ditangani' => 'Proses',
                            'sudah_ditangani' => 'Selesai',
                        ];
                    @endphp

                    @foreach ($statuses as $key => $label)
                        <a href="{{ route('keluhan.index', ['status' => $key, 'search' => request('search')]) }}"
                            class="px-8 py-2.5 rounded-full font-bold transition-all whitespace-nowrap text-sm {{ $currentStatus == $key ? 'bg-figmaRed text-white shadow-lg shadow-figmaRed/30' : 'bg-gray-200 text-gray-500 hover:bg-gray-300' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </form>
        </div>

        {{-- List Keluhan --}}
        <div class="space-y-4 pb-32 px-4">
            @forelse ($keluhans as $k)
                <a href="{{ route('keluhan.show', $k->id_keluhan) }}"
                    class="block bg-white p-6 rounded-[32px] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-50 relative group">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-bold text-gray-950 text-lg leading-tight">{{ $k->user->nama_user }}</h3>
                            <p class="text-[11px] text-gray-400 font-medium mt-1">{{ $k->created_at->format('d M Y H:i') }}
                            </p>
                        </div>

                        @php
                            $badgeStyle =
                                [
                                    'belum_ditangani' => 'bg-red-50 text-red-500',
                                    'sedang_ditangani' => 'bg-orange-50 text-orange-400',
                                    'sudah_ditangani' => 'bg-green-50 text-green-500',
                                ][$k->status_keluhan] ?? 'bg-gray-50 text-gray-500';

                            $statusLabel =
                                [
                                    'belum_ditangani' => 'Belum Ditangani',
                                    'sedang_ditangani' => 'Sedang Ditangani',
                                    'sudah_ditangani' => 'Sudah Ditangani',
                                ][$k->status_keluhan] ?? 'Status';
                        @endphp
                        <span class="text-[10px] font-bold px-3 py-1.5 rounded-full {{ $badgeStyle }}">
                            {{ $statusLabel }}
                        </span>
                    </div>
                    <p class="text-gray-500 text-sm mt-4 line-clamp-2">
                        {{ $k->judul_keluhan }}
                    </p>
                </a>
            @empty
                <div class="flex flex-col items-center justify-center pt-20 text-center">
                    <div
                        class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4 text-gray-300 text-3xl">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Data Keluhan Kosong</h3>
                    <p class="text-gray-400 text-sm">Belum ada riwayat keluhan yang ditemukan.</p>
                </div>
            @endforelse
        </div>
    </div>

    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
@endsection
