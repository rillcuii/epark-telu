@extends('layouts.admin')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Manajemen Akun Satpam</h2>
                <p class="text-sm text-gray-500">Daftar petugas satpam yang terdaftar di sistem</p>
            </div>
            <a href="{{ route('satpam.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition text-sm flex items-center">
                <i class="fas fa-plus mr-2"></i> Tambah Akun
            </a>
        </div>

        <div class="p-6">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 text-green-700">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-gray-400 text-xs uppercase tracking-wider border-b">
                            <th class="pb-3 px-2">ID User</th>
                            <th class="pb-3 px-2">Nama Lengkap</th>
                            <th class="pb-3 px-2">Username</th>
                            <th class="pb-3 px-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($satpams as $s)
                            <tr class="hover:bg-gray-50">
                                <td class="py-4 px-2 font-mono text-sm text-blue-600">{{ $s->id_user }}</td>
                                <td class="py-4 px-2 font-medium">{{ $s->nama_user }}</td>
                                <td class="py-4 px-2 text-gray-600">{{ $s->username }}</td>
                                <td class="py-4 px-2">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('satpam.edit', $s->id_user) }}"
                                            class="p-2 bg-amber-50 text-amber-600 rounded hover:bg-amber-100 transition"
                                            title="Edit Akun">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('satpam.destroy', $s->id_user) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Yakin anda ingin menghapus data Satpam ini?')"
                                                class="p-2 bg-red-50 text-red-600 rounded hover:bg-red-100 transition"
                                                title="Hapus Akun">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-10 text-center text-gray-400">Belum ada data satpam.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
