<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Park | Mahasiswa Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .sidebar.open {
                transform: translateX(0);
            }
        }

        .nav-item-active {
            background: rgba(255, 255, 255, 0.1);
            border-left: 4px solid #6366f1;
        }
    </style>
</head>

<body class="bg-[#F8FAFC] text-slate-900">

    <div class="flex min-h-screen">
        <aside id="sidebar"
            class="sidebar w-72 bg-[#0F172A] text-white flex-shrink-0 fixed md:static h-screen z-50 flex flex-col transition-all duration-300">

            <div class="p-8">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/30">
                        <i class="fas fa-parking text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-extrabold tracking-tight">E-PARK<span class="text-indigo-500">.</span>
                        </h1>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em]">Student Edition</p>
                    </div>
                </div>
            </div>

            <nav class="flex-grow px-4 pb-4 space-y-1">
                <p class="px-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-4">Main Menu</p>

                <a href="{{ route('mahasiswa.dashboard') }}"
                    class="flex items-center px-4 py-3.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('mahasiswa.dashboard') ? 'bg-indigo-600 text-white shadow-indigo-500/20 shadow-lg' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white' }}">
                    <i class="fas fa-grid-2 w-5 text-lg"></i>
                    <span class="ml-3 font-semibold text-sm tracking-wide">Dashboard</span>
                </a>

                <a href="{{ route('mahasiswa.pilih_kendaraan') }}"
                    class="flex items-center px-4 py-3.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('mahasiswa.pilih_kendaraan*') || request()->routeIs('mahasiswa.scanner*') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white' }}">
                    <i class="fas fa-qrcode w-5 text-lg"></i>
                    <span class="ml-3 font-semibold text-sm tracking-wide">Scan QR Parkir</span>
                </a>

                <a href="{{ route('riwayat.mahasiswa') }}"
                    class="flex items-center px-4 py-3.5 rounded-xl text-slate-400 hover:bg-slate-800/50 hover:text-white transition-all duration-200 group">
                    <i class="fas fa-history w-5 text-lg"></i>
                    <span class="ml-3 font-semibold text-sm tracking-wide">Riwayat Parkir</span>
                </a>

                <a href="{{ route('mahasiswa.kendaraan.index') }}"
                    class="flex items-center px-4 py-3.5 rounded-xl text-slate-400 hover:bg-slate-800/50 hover:text-white transition-all duration-200 group">
                    <i class="fas fa-motorcycle w-5 text-lg"></i>
                    <span class="ml-3 font-semibold text-sm tracking-wide">Kendaraan Saya</span>
                </a>

                <a href="{{ route('mahasiswa.keluhan.index') }}"
                    class="flex items-center px-4 py-3.5 rounded-xl text-slate-400 hover:bg-slate-800/50 hover:text-white transition-all duration-200 group">
                    <i class="fas fa-comment w-5 text-lg"></i>
                    <span class="ml-3 font-semibold text-sm tracking-wide">Keluhan Saya</span>
                </a>
            </nav>

            <div class="p-4 mt-auto">
                <div class="bg-slate-800/50 rounded-2xl p-4">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="flex items-center justify-center w-full py-2.5 px-4 bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white rounded-xl transition-all duration-300 font-bold text-xs uppercase tracking-widest">
                            <i class="fas fa-sign-out-alt mr-2"></i> Keluar Sistem
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div id="overlay" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 hidden md:hidden"
            onclick="toggleSidebar()"></div>

        <main class="flex-grow flex flex-col min-h-screen w-full overflow-x-hidden">
            <header class="bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-30">
                <div class="flex items-center justify-between px-8 py-4">
                    <button onclick="toggleSidebar()"
                        class="md:hidden w-10 h-10 flex items-center justify-center bg-slate-100 rounded-xl text-slate-600">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div class="flex items-center gap-4 ml-auto">
                        <div class="hidden md:block text-right">
                            <p class="text-sm font-bold text-slate-900 leading-none">{{ auth()->user()->nama_user }}</p>
                            <p class="text-[10px] font-bold text-indigo-500 uppercase tracking-tighter mt-1">Mahasiswa
                                Active</p>
                        </div>
                        <div
                            class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-indigo-600 to-violet-400 p-[2px] shadow-md shadow-indigo-100">
                            <div class="w-full h-full bg-white rounded-[14px] flex items-center justify-center">
                                <span
                                    class="font-black text-indigo-600">{{ substr(auth()->user()->nama_user, 0, 1) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="flex-grow p-6 md:p-10">
                @yield('content')
            </div>

            <footer class="py-6 px-10 border-t border-slate-100 text-center md:text-left">
                <p class="text-xs font-medium text-slate-400 uppercase tracking-widest">
                    &copy; 2026 E-PARK SYSTEM <span class="mx-2 text-slate-200">|</span> TELKOM UNIVERSITY
                </p>
            </footer>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('overlay').classList.toggle('hidden');
        }
    </script>
</body>

</html>
