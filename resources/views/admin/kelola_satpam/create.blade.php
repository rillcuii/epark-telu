@extends('layouts.admin')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-4">
            <a href="{{ route('satpam.index') }}" class="text-blue-600 hover:underline text-sm italic">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200 text-center">
                <h2 class="text-xl font-bold text-gray-800">Tambah Akun Satpam Baru</h2>
            </div>

            <form action="{{ route('satpam.store') }}" method="POST" class="p-8 space-y-6">
                @csrf

                @if ($errors->any())
                    <div class="p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm">
                        <i class="fas fa-exclamation-triangle mr-2"></i> {{ $errors->first() }}
                    </div>
                @endif

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama_user" value="{{ old('nama_user') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                        placeholder="Masukkan nama lengkap petugas">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                        placeholder="budi_satpam">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                        placeholder="********">
                    <p class="text-xs text-gray-400 mt-1 italic">*Minimal 6 karakter</p>
                </div>

                <div class="pt-4 text-center">
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg shadow-lg shadow-blue-200 transition">
                        <i class="fas fa-save mr-2"></i> Simpan Akun Satpam
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
