@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="mb-4">
            <a href="{{ route('keluhan.index') }}" class="text-blue-600 text-sm italic"><i class="fas fa-arrow-left"></i>
                Kembali</a>
        </div>

        <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
            <div class="p-6 border-b bg-gray-50">
                <h2 class="text-xl font-bold">Detail Keluhan</h2>
            </div>

            <div class="p-8">
                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-400 uppercase">Pengirim</label>
                    <p class="text-lg font-semibold text-gray-800">{{ $keluhan->user->nama_user }}
                        ({{ $keluhan->user->username }})</p>
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-400 uppercase">Isi Keluhan</label>
                    <div class="p-4 bg-gray-50 rounded-lg border italic text-gray-700 mt-2">
                        "{{ $keluhan->keterangan_keluhan }}"
                    </div>
                </div>

                <hr class="my-8">

                <form action="{{ route('keluhan.update', $keluhan->id_keluhan) }}" method="POST">
                    @csrf
                    <label class="block text-sm font-bold text-gray-700 mb-4">Pembaruan Status Keluhan:</label>

                    <div class="space-y-3">
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="status_keluhan" value="belum_ditangani"
                                {{ $keluhan->status_keluhan == 'belum_ditangani' ? 'checked' : '' }}>
                            <span class="ml-3">Belum Ditangani</span>
                        </label>

                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="status_keluhan" value="sedang_ditangani"
                                {{ $keluhan->status_keluhan == 'sedang_ditangani' ? 'checked' : '' }}>
                            <span class="ml-3">Sedang Ditangani</span>
                        </label>

                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="status_keluhan" value="sudah_ditangani"
                                {{ $keluhan->status_keluhan == 'sudah_ditangani' ? 'checked' : '' }}>
                            <span class="ml-3">Sudah Ditangani</span>
                        </label>
                    </div>

                    <div class="mt-8">
                        <button type="submit"
                            class="w-full bg-slate-800 text-white font-bold py-3 rounded-xl hover:bg-black transition shadow-lg">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
