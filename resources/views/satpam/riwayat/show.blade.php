@extends('layouts.satpam')

@section('content')
    <div class="min-h-screen bg-[#F8F9FA] relative">
        <div class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-[430px] z-50">
            <div class="bg-figmaRed h-32 flex items-center px-8 rounded-b-[40px] shadow-lg">
                <a href="{{ route('satpam.riwayat_parkir') }}" class="text-white text-2xl mr-6 transition active:scale-90">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-white text-xl font-bold tracking-tight">Detail Data Kendaraan</h1>
            </div>
        </div>

        <div class="px-6 pt-24 pb-24 max-w-[430px] mx-auto">
            <h2 class="text-lg font-bold text-gray-900 mb-4 ml-1">Detail Kendaraan</h2>

            <div class="bg-white rounded-[28px] shadow-sm border border-gray-50 relative overflow-hidden p-6">
                <div class="absolute left-0 top-6 bottom-6 w-1 bg-[#EE2B2B] rounded-r-full"></div>

                <div class="space-y-5">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex gap-2.5">
                            <div class="mt-1 w-1.5 h-1.5 rounded-full bg-[#EE2B2B] shrink-0"></div>
                            <div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-tighter">No. Polisi</p>
                                <p class="text-sm font-bold text-gray-900">{{ $parkir->kendaraan->nomor_polisi }}</p>
                            </div>
                        </div>
                        <div class="flex gap-2.5">
                            <div class="mt-1 w-1.5 h-1.5 rounded-full bg-[#EE2B2B] shrink-0"></div>
                            <div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-tighter">Model</p>
                                <p class="text-sm font-bold text-gray-900 truncate">
                                    {{ $parkir->kendaraan->model_kendaraan }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex gap-2.5">
                            <div class="mt-1 w-1.5 h-1.5 rounded-full bg-[#EE2B2B] shrink-0"></div>
                            <div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-tighter">Pemilik</p>
                                <p class="text-sm font-bold text-gray-900 truncate">{{ $parkir->user->nama_user }}</p>
                            </div>
                        </div>
                        <div class="flex gap-2.5">
                            <div class="mt-1 w-1.5 h-1.5 rounded-full bg-[#EE2B2B] shrink-0"></div>
                            <div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-tighter">Warna</p>
                                <p class="text-sm font-bold text-gray-900">{{ $parkir->kendaraan->warna_kendaraan ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="h-[1px] bg-gray-50 w-full my-2"></div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex gap-2.5">
                            <div class="mt-1 w-1.5 h-1.5 rounded-full bg-blue-500 shrink-0"></div>
                            <div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-tighter">Waktu Masuk</p>
                                <p class="text-sm font-bold text-gray-900">
                                    {{ \Carbon\Carbon::parse($parkir->waktu_masuk)->format('H:i') }}</p>
                            </div>
                        </div>
                        <div class="flex gap-2.5">
                            <div class="mt-1 w-1.5 h-1.5 rounded-full bg-gray-300 shrink-0"></div>
                            <div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-tighter">Waktu Keluar</p>
                                <p class="text-sm font-bold text-gray-900">
                                    {{ $parkir->waktu_keluar ? \Carbon\Carbon::parse($parkir->waktu_keluar)->format('H:i') : '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4 pt-2">
                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 rounded-full bg-[#EE2B2B]"></div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-tighter">Foto Unit</p>
                            </div>
                            <div class="rounded-2xl overflow-hidden border border-gray-100 h-32 bg-gray-50 shadow-inner">
                                @if ($parkir->kendaraan->url_foto_kendaraan)
                                    <img src="{{ asset('storage/' . $parkir->kendaraan->url_foto_kendaraan) }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full">
                                        <i class="fas fa-image text-gray-200 text-3xl"></i>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 rounded-full bg-[#EE2B2B]"></div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-tighter">Foto STNK</p>
                            </div>
                            <div class="rounded-2xl overflow-hidden border border-gray-100 h-32 bg-gray-50 shadow-inner">
                                @if ($parkir->kendaraan->url_foto_stnk)
                                    <img src="{{ asset('storage/' . $parkir->kendaraan->url_foto_stnk) }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full">
                                        <i class="fas fa-file-invoice text-gray-200 text-3xl"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[430px] flex justify-center z-50">
            <div class="relative w-full flex justify-center">
                <div class="absolute bottom-0 w-full h-10 bg-white shadow-[0_-5px_15px_rgba(0,0,0,0.03)]"
                    style="clip-path: polygon(0 0, 38% 0, 42% 40%, 50% 60%, 58% 40%, 62% 0, 100% 0, 100% 100%, 0 100%);">
                </div>
                <div class="relative -top-6 bg-white p-2 rounded-full shadow-lg">
                    <div
                        class="w-14 h-14 bg-[#F1F3F4] rounded-full flex items-center justify-center border border-gray-100 shadow-inner">
                        <i class="fas fa-list-ul text-2xl text-gray-800"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
