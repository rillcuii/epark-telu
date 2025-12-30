@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Keluhan Mahasiswa</h2>
    </div>

    <form action="{{ route('keluhan.index') }}" method="GET" class="mb-6 flex flex-wrap gap-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari mahasiswa atau isi..."
            class="border p-2 rounded-lg w-full md:w-64 focus:ring-2 focus:ring-blue-500">

        <select name="status" class="border p-2 rounded-lg focus:ring-2 focus:ring-blue-500">
            <option value="Semua">Semua Status</option>
            <option value="belum_ditangani" {{ request('status') == 'belum_ditangani' ? 'selected' : '' }}>Belum Ditangani
            </option>
            <option value="sedang_ditangani" {{ request('status') == 'sedang_ditangani' ? 'selected' : '' }}>Sedang
                Ditangani</option>
            <option value="sudah_ditangani" {{ request('status') == 'sudah_ditangani' ? 'selected' : '' }}>Sudah Ditangani
            </option>
        </select>

        <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Filter</button>
    </form>

    @if ($keluhans->isEmpty())
        <div class="bg-white p-10 text-center rounded-xl shadow-sm border border-dashed border-gray-300">
            <p class="text-gray-500 italic">Data keluhan Kosong</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($keluhans as $k)
                <a href="{{ route('keluhan.show', $k->id_keluhan) }}"
                    class="block p-5 bg-white rounded-xl shadow-sm border border-gray-200 hover:border-blue-500 transition">
                    <div class="flex justify-between items-start mb-3">
                        <span
                            class="text-xs font-bold px-2 py-1 rounded 
                    {{ $k->status_keluhan == 'belum_ditangani' ? 'bg-red-100 text-red-600' : '' }}
                    {{ $k->status_keluhan == 'sedang_ditangani' ? 'bg-yellow-100 text-yellow-600' : '' }}
                    {{ $k->status_keluhan == 'sudah_ditangani' ? 'bg-green-100 text-green-600' : '' }}">
                            {{ ucwords(str_replace('_', ' ', $k->status_keluhan)) }}
                        </span>
                        <span class="text-xs text-gray-400">{{ $k->created_at->format('d M Y') }}</span>
                    </div>
                    <h3 class="font-bold text-gray-800">{{ $k->user->nama_user }}</h3>
                    <p class="text-sm text-gray-600 mt-2 line-clamp-2 italic">"{{ $k->judul_keluhan }}"</p>
                </a>
            @endforeach
        </div>
    @endif
@endsection
