@extends('layouts.mahasiswa')

@section('content')
    <div class="max-w-2xl mx-auto pb-20">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Kendaraan Saya</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Kelola data kendaraan aktif Anda
                </p>
            </div>
            <a href="{{ route('mahasiswa.kendaraan.create') }}"
                class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition">
                <i class="fas fa-plus mr-2"></i> Tambah
            </a>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center gap-3">
                <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white text-xs">
                    <i class="fas fa-check"></i>
                </div>
                <p class="text-emerald-700 text-xs font-black uppercase tracking-wider">{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid gap-4">
            @forelse($kendaraans as $k)
                <div
                    class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm flex items-center justify-between group hover:border-indigo-100 transition-all">
                    <div class="flex items-center gap-5">
                        <div
                            class="w-16 h-16 bg-slate-50 rounded-3xl flex items-center justify-center text-slate-400 group-hover:bg-indigo-50 group-hover:text-indigo-500 transition">
                            <i class="fas fa-motorcycle text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-black text-slate-900 leading-none">{{ $k->nomor_polisi }}</h3>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2">
                                {{ $k->model_kendaraan }} • <span class="text-slate-300">{{ $k->warna_kendaraan }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('mahasiswa.kendaraan.edit', $k->id_kendaraan) }}"
                            class="w-10 h-10 bg-slate-50 text-slate-400 rounded-xl flex items-center justify-center hover:bg-indigo-50 hover:text-indigo-600 transition">
                            <i class="fas fa-edit text-xs"></i>
                        </a>

                        <form id="form-hapus-{{ $k->id_kendaraan }}"
                            action="{{ route('mahasiswa.kendaraan.destroy', $k->id_kendaraan) }}" method="POST">
                            @csrf
                            <button type="button" onclick="konfirmasiHapus('{{ $k->id_kendaraan }}')"
                                class="w-10 h-10 bg-slate-50 text-slate-400 rounded-xl flex items-center justify-center hover:bg-red-50 hover:text-red-600 transition">
                                <i class="fas fa-trash text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-200">
                    <i class="fas fa-car-side text-4xl text-slate-200 mb-4"></i>
                    <p class="text-sm font-bold text-slate-400 uppercase">Belum ada kendaraan</p>
                </div>
            @endforelse
        </div>
    </div>
    <script>
        function konfirmasiHapus(id) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: "Yakin ingin menghapus data kendaraan ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4f46e5', // Warna Indigo-600 (sesuai tema kamu)
                cancelButtonColor: '#f1f5f9',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-[2rem]',
                    confirmButton: 'rounded-xl px-6 py-3 font-black text-xs uppercase tracking-widest',
                    cancelButton: 'rounded-xl px-6 py-3 font-black text-xs uppercase tracking-widest text-slate-600'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika mahasiswa memilih "Ya"
                    document.getElementById('form-hapus-' + id).submit();
                }
                // Jika memilih "Tidak", otomatis kembali ke halaman (modal tertutup)
            })
        }
    </script>

@endsection
