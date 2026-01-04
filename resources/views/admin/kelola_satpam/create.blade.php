@extends('layouts.admin')

@section('content')
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-[430px] z-50">
        <div class="bg-figmaRed h-32 flex items-center px-8 rounded-b-[40px] shadow-lg">
            <a href="{{ route('satpam.index') }}" class="text-white text-2xl mr-6">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-white text-xl font-bold tracking-tight">Tambah Akun Satpam</h1>
        </div>
    </div>

    <div class="h-2"></div>

    <div class="px-6 pb-20">
        <div class="bg-white rounded-[32px] shadow-xl shadow-gray-100 border border-gray-50 flex overflow-hidden">
            <div class="w-2 bg-figmaRed"></div>

            <div class="flex-grow p-8">
                <h2 class="text-xl font-black text-gray-950 mb-2">Tambah Akun</h2>
                <p class="text-[11px] text-gray-400 font-medium mb-8">
                    Isi form dibawah ini untuk melakukan registrasi akun Satpam
                </p>

                <form action="{{ route('satpam.store') }}" method="POST">
                    @csrf

                    <div class="mb-5">
                        <label class="block text-xs font-bold text-gray-950 mb-2 ml-1">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <i class="fas fa-user-edit"></i>
                            </div>
                            <input type="text" name="nama_user" value="{{ old('nama_user') }}"
                                class="w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-bold focus:ring-2 focus:ring-figmaRed/20 focus:bg-white outline-none transition-all placeholder:text-gray-300"
                                placeholder="Ahmad Sahroni">
                        </div>
                        @if ($errors->has('nama_user'))
                            <p class="text-[10px] text-figmaRed font-bold mt-2 ml-1">*Data tidak lengkap. Silahkan isi
                                seluruh form.</p>
                        @endif
                    </div>

                    <div class="mb-5">
                        <label class="block text-xs font-bold text-gray-950 mb-2 ml-1">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <i class="fas fa-user-tag"></i>
                            </div>
                            <input type="text" name="username" value="{{ old('username') }}"
                                class="w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-bold focus:ring-2 focus:ring-figmaRed/20 focus:bg-white outline-none transition-all placeholder:text-gray-300"
                                placeholder="SahroniSahroni123">
                        </div>
                        @if ($errors->has('username'))
                            @php $userErr = $errors->first('username'); @endphp
                            @if (str_contains($userErr, 'required'))
                                <p class="text-[10px] text-figmaRed font-bold mt-2 ml-1">*Data tidak lengkap. Silahkan isi
                                    seluruh form.</p>
                            @else
                                <p class="text-[10px] text-figmaRed font-bold mt-2 ml-1">*Username sudah digunakan, pilih
                                    username lain !</p>
                            @endif
                        @endif
                    </div>

                    <div class="mb-8">
                        <label class="block text-xs font-bold text-gray-950 mb-2 ml-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <i class="fas fa-lock"></i>
                            </div>
                            <input type="password" name="password" id="pass"
                                class="w-full pl-12 pr-12 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-bold focus:ring-2 focus:ring-figmaRed/20 focus:bg-white outline-none transition-all placeholder:text-gray-300"
                                placeholder="********">
                            <button type="button" onclick="toggle()" class="absolute inset-y-0 right-0 pr-4 text-gray-300">
                                <i class="fas fa-eye" id="eye"></i>
                            </button>
                        </div>
                        @if ($errors->has('password'))
                            @php $passErr = $errors->first('password'); @endphp
                            @if (str_contains($passErr, 'required'))
                                <p class="text-[10px] text-figmaRed font-bold mt-2 ml-1">*Data tidak lengkap. Silahkan isi
                                    seluruh form.</p>
                            @else
                                <p class="text-[10px] text-figmaRed font-bold mt-2 ml-1">*Data tidak sesuai format !</p>
                            @endif
                        @endif
                    </div>

                    @if ($errors->any())
                        <div class="flex items-center gap-2 mb-8 ml-1">
                            <div
                                class="w-5 h-5 bg-figmaRed rounded-full flex items-center justify-center shadow-lg shadow-figmaRed/20">
                                <i class="fas fa-exclamation text-[10px] text-white"></i>
                            </div>
                            <p class="text-[10px] text-figmaRed font-bold">Data tidak lengkap. Silahkan isi seluruh form.
                            </p>
                        </div>
                    @endif

                    <button type="submit"
                        class="w-full py-4 bg-figmaRed text-white rounded-2xl font-black text-sm shadow-xl shadow-figmaRed/30 active:scale-95 transition-transform">
                        Tambah
                    </button>
                </form>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div id="successModal"
            class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-black/20 backdrop-blur-sm">
            <div class="bg-white w-full max-w-[320px] rounded-[40px] p-10 text-center shadow-2xl">
                <div
                    class="w-20 h-20 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6 text-4xl">
                    <i class="fas fa-check"></i>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-2">Berhasil Disimpan!</h4>
                <p class="text-[11px] text-gray-400 font-medium mb-10">Data Berhasil ditambahkan</p>
                <button onclick="window.location='{{ route('satpam.index') }}'"
                    class="w-full py-4 bg-figmaRed text-white rounded-2xl font-bold text-base shadow-lg shadow-figmaRed/30">
                    Oke, Mengerti
                </button>
            </div>
        </div>
    @endif

    <script>
        function toggle() {
            const p = document.getElementById('pass');
            const i = document.getElementById('eye');
            p.type = p.type === "password" ? "text" : "password";
            i.classList.toggle('fa-eye');
            i.classList.toggle('fa-eye-slash');
        }
    </script>
@endsection
