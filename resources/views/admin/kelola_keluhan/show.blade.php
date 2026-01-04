@extends('layouts.admin')

@section('content')
    {{-- Header Fixed --}}
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-[430px] z-50">
        <div class="bg-figmaRed h-32 flex items-center px-8 rounded-b-[40px] shadow-lg">
            <a href="{{ route('keluhan.index') }}" class="text-white text-2xl mr-6 transition active:scale-90">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-white text-xl font-bold tracking-tight">Detail Keluhan</h1>
        </div>
    </div>

    {{-- Content Container --}}
    <div class="pt-2 px-6 pb-20 max-w-[430px] mx-auto bg-white min-h-screen">

        {{-- Info Pengirim --}}
        <div class="flex justify-between items-start mb-6">
            <div>
                <h2 class="text-xl font-extrabold text-gray-950">{{ $keluhan->user->nama_user }}</h2>
                <p class="text-sm text-gray-400 font-medium">{{ $keluhan->created_at->format('d M Y H:i') }}</p>
            </div>

            @php
                $statusColors = [
                    'belum_ditangani' => 'bg-red-50 text-red-500',
                    'sedang_ditangani' => 'bg-orange-50 text-orange-400',
                    'sudah_ditangani' => 'bg-green-50 text-green-500',
                ];
                $badgeStyle = $statusColors[$keluhan->status_keluhan] ?? 'bg-gray-50 text-gray-500';
            @endphp
            <span class="text-[10px] font-bold px-3 py-1.5 rounded-full {{ $badgeStyle }}">
                {{ str_replace('_', ' ', ucwords($keluhan->status_keluhan)) }}
            </span>
        </div>

        {{-- Isi Keluhan --}}
        <div class="mb-10">
            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $keluhan->judul_keluhan }}</h3>
            <p class="text-gray-500 text-sm leading-relaxed text-justify">
                {{ $keluhan->keterangan_keluhan }}
            </p>
        </div>

        {{-- Form Update Status --}}
        <form action="{{ route('keluhan.update', $keluhan->id_keluhan) }}" method="POST">
            @csrf

            <h4 class="text-sm font-bold text-gray-950 mb-4 uppercase tracking-wider">Status Tindak Lanjut</h4>

            <div class="space-y-3">
                @php
                    $options = [
                        'belum_ditangani' => ['label' => 'Belum Ditangani', 'color' => 'red'],
                        'sedang_ditangani' => ['label' => 'Sedang Ditangani', 'color' => 'orange'],
                        'sudah_ditangani' => ['label' => 'Sudah Ditangani', 'color' => 'green'],
                    ];
                @endphp

                @foreach ($options as $val => $data)
                    <label class="relative flex items-center group cursor-pointer">
                        <input type="radio" name="status_keluhan" value="{{ $val }}" class="peer hidden"
                            {{ $keluhan->status_keluhan == $val ? 'checked' : '' }}>
                        <div
                            class="w-full p-4 rounded-2xl border-2 border-gray-100 flex items-center justify-between transition-all 
                            peer-checked:border-{{ $data['color'] }}-500 peer-checked:bg-{{ $data['color'] }}-50/30">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-5 h-5 border-2 border-gray-300 rounded-full flex items-center justify-center peer-checked:border-{{ $data['color'] }}-500">
                                    <div
                                        class="w-2.5 h-2.5 bg-{{ $data['color'] }}-500 rounded-full opacity-0 transition-opacity peer-checked:opacity-100">
                                    </div>
                                </div>
                                <span class="text-sm font-bold text-gray-700">{{ $data['label'] }}</span>
                            </div>
                            <span
                                class="text-[9px] font-black px-2 py-1 rounded-md bg-{{ $data['color'] }}-100 text-{{ $data['color'] }}-500 uppercase tracking-tighter">
                                {{ $data['label'] }}
                            </span>
                        </div>
                    </label>
                @endforeach
            </div>

            <div class="mt-10">
                <button type="submit"
                    class="w-full py-4 bg-figmaRed text-white rounded-2xl font-bold text-base shadow-lg shadow-figmaRed/30 transition active:scale-95">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <style>
        /* Memastikan titik radio muncul saat checked */
        input:checked+div .w-2\.5 {
            opacity: 1 !important;
        }
    </style>
@endsection
