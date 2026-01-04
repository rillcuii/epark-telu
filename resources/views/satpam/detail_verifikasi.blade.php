@extends('layouts.satpam')

@section('content')
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-[430px] z-50">
        <div class="bg-figmaRed h-32 flex items-center px-8 rounded-b-[40px] shadow-lg">
            <a href="{{ route('satpam.dashboard') }}" class="text-white text-2xl mr-6 transition active:scale-90">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-white text-xl font-bold tracking-tight">Detail Data Kendaraan</h1>
        </div>
    </div>

    <div class="px-5 pt-24 pb-20">
        <h2 class="text-lg font-bold text-gray-900 mb-3 ml-1">Detail Kendaraan</h2>

        <div class="bg-white rounded-[28px] shadow-sm border border-gray-50 relative overflow-hidden p-5">
            <div class="absolute left-0 top-4 bottom-4 w-1 bg-[#EE2B2B] rounded-r-full"></div>

            <div class="space-y-4">
                <div class="grid gap-3">
                    <div class="flex gap-2.5">
                        <div class="mt-1 w-1.5 h-1.5 rounded-full bg-[#EE2B2B] shrink-0"></div>
                        <div>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-tighter">No. Polisi</p>
                            <p class="text-xs font-bold text-gray-900">{{ $data->nomor_polisi }}</p>
                        </div>
                    </div>
                    <div class="flex gap-2.5">
                        <div class="mt-1 w-1.5 h-1.5 rounded-full bg-[#EE2B2B] shrink-0"></div>
                        <div>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-tighter">Model</p>
                            <p class="text-xs font-bold text-gray-900 truncate">{{ $data->model_kendaraan }}</p>
                        </div>
                    </div>
                </div>

                <div class="grid gap-3">
                    <div class="flex gap-2.5">
                        <div class="mt-1 w-1.5 h-1.5 rounded-full bg-[#EE2B2B] shrink-0"></div>
                        <div>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-tighter">Pemilik</p>
                            <p class="text-xs font-bold text-gray-900 truncate">{{ $data->nama_user }}</p>
                        </div>
                    </div>
                    <div class="flex gap-2.5">
                        <div class="mt-1 w-1.5 h-1.5 rounded-full bg-[#EE2B2B] shrink-0"></div>
                        <div>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-tighter">Warna</p>
                            <p class="text-xs font-bold text-gray-900">{{ $data->warna_kendaraan ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="h-[1px] bg-gray-50 w-full"></div>

                <div class="grid gap-3">
                    <div class="space-y-1.5">
                        <div class="flex items-center gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-[#EE2B2B]"></div>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-tighter">Foto Unit</p>
                        </div>
                        @if ($data->url_foto_kendaraan)
                            <div class="rounded-2xl overflow-hidden border border-gray-100 h-28">
                                <img src="{{ asset('storage/' . $data->url_foto_kendaraan) }}"
                                    class="w-full h-full object-cover">
                            </div>
                        @else
                            <div
                                class="bg-gray-50 rounded-2xl h-28 flex items-center justify-center border border-dashed border-gray-200">
                                <i class="fas fa-image text-gray-200 text-xl"></i>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-1.5">
                        <div class="flex items-center gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-[#EE2B2B]"></div>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-tighter">Foto STNK</p>
                        </div>
                        @if ($data->url_foto_stnk)
                            <div class="rounded-2xl overflow-hidden border border-gray-100 h-28">
                                <img src="{{ asset('storage/' . $data->url_foto_stnk) }}"
                                    class="w-full h-full object-cover">
                            </div>
                        @else
                            <div
                                class="bg-gray-50 rounded-2xl h-28 flex items-center justify-center border border-dashed border-gray-200">
                                <i class="fas fa-file-invoice text-gray-200 text-xl"></i>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- <div class="pt-2">
                    <button
                        class="w-full py-3 bg-[#EE2B2B] text-white rounded-xl text-[11px] font-bold shadow-md shadow-red-100 active:scale-95 transition uppercase tracking-widest">
                        Konfirmasi Aman
                    </button>
                </div> --}}
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
