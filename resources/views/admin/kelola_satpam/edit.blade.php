@extends('layouts.admin')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-4">
            <a href="{{ route('satpam.index') }}"
                class="text-blue-600 hover:text-blue-800 text-sm flex items-center transition">
                <i class="fas fa-chevron-left mr-2"></i> Kembali ke Daftar Satpam
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-200 bg-gray-50">
                <h2 class="text-xl font-bold text-gray-800">Edit Akun Satpam</h2>
                <p class="text-xs text-gray-500 mt-1">Mengubah data untuk petugas: <span
                        class="font-semibold text-blue-600">{{ $satpam->nama_user }}</span></p>
            </div>

            <form action="{{ route('satpam.update', $satpam->id_user) }}" method="POST" class="p-8 space-y-6">
                @csrf

                @if ($errors->any())
                    <div class="p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm animate-pulse">
                        <div class="flex">
                            <i class="fas fa-exclamation-circle mt-1 mr-3"></i>
                            <div>
                                <span class="font-bold">Terjadi Kesalahan:</span>
                                <p>{{ $errors->first() }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap Petugas</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fas fa-user text-sm"></i>
                        </span>
                        <input type="text" name="nama_user" value="{{ old('nama_user', $satpam->nama_user) }}"
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                            placeholder="Nama Lengkap">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fas fa-at text-sm"></i>
                        </span>
                        <input type="text" name="username" value="{{ old('username', $satpam->username) }}"
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                            placeholder="username_satpam">
                    </div>
                    <p class="text-xs text-gray-400 mt-1 italic font-light">*Username digunakan untuk login sistem.</p>
                </div>

                <div class="bg-amber-50 p-4 rounded-lg border border-amber-100">
                    <label class="block text-sm font-semibold text-amber-800 mb-2">Password Baru (Opsional)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-amber-400">
                            <i class="fas fa-lock text-sm"></i>
                        </span>
                        <input type="password" name="password"
                            class="w-full pl-10 pr-4 py-2 border border-amber-200 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none transition"
                            placeholder="********">
                    </div>
                    <p class="text-xs text-amber-600 mt-2 italic flex items-center">
                        <i class="fas fa-info-circle mr-1 text-[10px]"></i>
                        Biarkan kosong jika tidak ingin mengubah password lama.
                    </p>
                </div>

                <div class="pt-6 flex items-center justify-end space-x-4">
                    <a href="{{ route('satpam.index') }}" class="text-gray-500 hover:text-gray-700 font-medium transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2.5 px-8 rounded-lg shadow-md shadow-amber-100 transition flex items-center">
                        <i class="fas fa-sync-alt mr-2"></i> Perbarui Akun
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
