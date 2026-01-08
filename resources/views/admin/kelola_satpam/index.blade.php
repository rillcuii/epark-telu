@extends('layouts.admin')

@section('content')
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-[430px] z-50">
        <div class="bg-figmaRed h-32 flex items-center px-8 rounded-b-[40px] shadow-lg">
            <a href="{{ route('admin.dashboard') }}" class="text-white text-2xl mr-6">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-white text-xl font-bold tracking-tight">Kelola Akun Satpam</h1>
        </div>
    </div>
    <div class="px-2">
        <h2 class="text-2xl font-black text-gray-950 mb-6 px-4">Daftar Satpam</h2>

        @if (session('success'))
            <div id="statusModal"
                class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-black/20 backdrop-blur-sm">
                <div class="bg-white w-full max-w-[320px] rounded-[40px] p-10 text-center shadow-2xl">
                    <div
                        class="w-20 h-20 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6 text-4xl">
                        <i class="fas fa-check"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Berhasil Disimpan!</h4>
                    <p class="text-sm text-gray-400 mb-8">{{ session('success') }}</p>
                    <button onclick="document.getElementById('statusModal').remove()"
                        class="w-full py-4 bg-figmaRed text-white rounded-2xl font-bold text-base shadow-lg shadow-figmaRed/30">
                        Oke, Mengerti
                    </button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div id="statusModal"
                class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-black/20 backdrop-blur-sm">
                <div class="bg-white w-full max-w-[320px] rounded-[40px] p-10 text-center shadow-2xl">
                    <div
                        class="w-20 h-20 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 text-4xl">
                        <i class="fas fa-times"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Gagal!</h4>
                    <p class="text-sm text-gray-400 mb-8">{{ session('error') }}</p>
                    <button onclick="document.getElementById('statusModal').remove()"
                        class="w-full py-4 bg-gray-500 text-white rounded-2xl font-bold text-base shadow-lg">
                        Tutup
                    </button>
                </div>
            </div>
        @endif

        <div class="space-y-4 pb-32">
            @forelse($satpams as $s)
                <div
                    class="bg-white rounded-2xl border border-gray-100 shadow-md flex items-stretch overflow-hidden mx-4 h-20">
                    <div class="w-2 bg-figmaRed"></div>
                    <div class="flex-grow flex items-center justify-between px-6">
                        <div class="flex flex-col">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-figmaRed rounded-full"></span>
                                <h3 class="text-base font-extrabold text-gray-950">{{ $s->nama_user }}</h3>
                            </div>

                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('satpam.edit', $s->id_user) }}"
                                class="w-10 h-10 flex items-center justify-center border border-gray-200 rounded-xl text-gray-400">
                                <i class="fas fa-edit text-sm"></i>
                            </a>
                            <button type="button" onclick="confirmDelete('{{ $s->id_user }}')"
                                class="w-10 h-10 flex items-center justify-center border border-gray-200 rounded-xl text-gray-400">
                                <i class="fas fa-trash-can text-sm"></i>
                            </button>

                            <form id="delete-form-{{ $s->id_user }}" action="{{ route('satpam.destroy', $s->id_user) }}"
                                method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 text-gray-400">Belum ada data.</div>
            @endforelse
        </div>
    </div>

    <div id="deleteModal"
        class="fixed inset-0 z-[100] hidden flex items-center justify-center p-6 bg-black/20 backdrop-blur-sm">
        <div class="bg-white w-full max-w-[300px] rounded-[35px] p-8 shadow-2xl">
            <h4 class="text-xl font-bold text-gray-900 mb-3">Peringatan</h4>
            <p class="text-sm text-gray-600 font-medium mb-10 leading-relaxed">
                Yakin anda ingin menghapus data Satpam ini ?
            </p>
            <div class="grid grid-cols-2 gap-3">
                <button onclick="closeDeleteModal()"
                    class="py-3 bg-gray-200 text-gray-900 rounded-xl font-bold text-sm transition active:scale-95">
                    Tidak
                </button>
                <button id="confirmDeleteBtn"
                    class="py-3 bg-figmaRed text-white rounded-xl font-bold text-sm shadow-lg shadow-figmaRed/30 transition active:scale-95">
                    Ya
                </button>
            </div>
        </div>
    </div>

    <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[430px]">
        <div class="relative h-20 bg-gray-50 flex justify-center items-center rounded-t-[40px] border-t border-gray-100">
            <div class="absolute -top-10 w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-sm">
                <a href="{{ route('satpam.create') }}"
                    class="w-20 h-20 bg-white border-4 border-gray-50 rounded-full flex items-center justify-center text-gray-900 shadow-xl">
                    <i class="fas fa-plus text-3xl font-light"></i>
                </a>
            </div>
        </div>
    </div>

    <script>
        let currentDeleteId = null;

        function confirmDelete(id) {
            currentDeleteId = id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            currentDeleteId = null;
        }

        // Eksekusi form hapus saat tombol "Ya" diklik
        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (currentDeleteId) {
                document.getElementById('delete-form-' + currentDeleteId).submit();
            }
        });
    </script>
@endsection
