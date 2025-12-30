@extends('layouts.satpam')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Riwayat Parkir</h1>
            <p class="text-sm text-gray-500 italic">Monitoring data masuk dan keluar kendaraan mahasiswa.</p>
        </div>

        <div class="bg-white p-2 rounded-xl shadow-sm border border-gray-100 flex items-center gap-2">
            <form action="{{ route('satpam.riwayat_parkir') }}" method="GET" class="flex gap-2">
                <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                    class="border-none bg-gray-50 rounded-lg text-sm focus:ring-red-500">
                <button class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-red-700 transition">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
            </form>
            @if (request('tanggal'))
                <a href="{{ route('satpam.riwayat_parkir') }}" class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                    <i class="fas fa-times"></i>
                </a>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Mahasiswa</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Kendaraan</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">
                            Waktu Masuk</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">
                            Waktu Keluar</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">
                            Status</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($riwayats as $r)
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-gray-900 leading-none">{{ $r->user->nama_user }}</p>
                                <p class="text-[10px] text-gray-400 font-medium mt-1">{{ $r->user->nim ?? 'NIM tidak ada' }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-block bg-gray-100 text-gray-800 text-[10px] font-black px-2 py-1 rounded-md mb-1">{{ $r->kendaraan->plat_nomor }}</span>
                                <p class="text-[10px] text-gray-400 uppercase">{{ $r->kendaraan->model_kendaraan }}</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <p class="text-xs font-semibold text-gray-700">
                                    {{ \Carbon\Carbon::parse($r->waktu_masuk)->format('H:i') }}</p>
                                <p class="text-[9px] text-gray-400">
                                    {{ \Carbon\Carbon::parse($r->waktu_masuk)->format('d/m/Y') }}</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($r->waktu_keluar)
                                    <p class="text-xs font-semibold text-gray-700">
                                        {{ \Carbon\Carbon::parse($r->waktu_keluar)->format('H:i') }}</p>
                                    <p class="text-[9px] text-gray-400">
                                        {{ \Carbon\Carbon::parse($r->waktu_keluar)->format('d/m/Y') }}</p>
                                @else
                                    <span class="text-[10px] text-gray-300 italic">Belum Keluar</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-tighter {{ $r->status == 'masuk' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $r->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('satpam.riwayat.detail', $r->id_parkir) }}"
                                    class="inline-flex items-center justify-center w-8 h-8 bg-gray-100 text-gray-600 rounded-lg hover:bg-red-600 hover:text-white transition">
                                    <i class="fas fa-eye text-xs"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-20 text-center">
                                <div class="max-w-xs mx-auto text-gray-400">
                                    <i class="fas fa-folder-open text-4xl mb-4 opacity-20"></i>
                                    <p class="text-sm font-medium italic">Data riwayat parkir tidak ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $riwayats->links() }}
    </div>
@endsection
