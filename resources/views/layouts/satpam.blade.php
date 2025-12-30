<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Satpam Dashboard | E-Park</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <aside id="sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0">
        <div class="h-full px-3 py-4 overflow-y-auto bg-slate-900">
            <div class="flex items-center ps-2.5 mb-10">
                <div class="p-2 bg-red-600 rounded-lg mr-3">
                    <i class="fas fa-shield-alt text-white"></i>
                </div>
                <span
                    class="self-center text-xl font-extrabold whitespace-nowrap text-white uppercase tracking-tighter">E-Park
            </div>

            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('satpam.dashboard') }}"
                        class="flex items-center p-3 text-gray-300 rounded-xl hover:bg-red-600 hover:text-white transition group {{ request()->routeIs('satpam.dashboard') ? 'bg-red-600 text-white' : '' }}">
                        <i class="fas fa-th-large w-5"></i>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('satpam.riwayat_parkir') }}"
                        class="flex items-center p-3 text-gray-300 rounded-xl hover:bg-red-600 hover:text-white transition group {{ request()->routeIs('satpam.riwayat_parkir*') ? 'bg-red-600 text-white' : '' }}">
                        <i class="fas fa-history w-5"></i>
                        <span class="ms-3">Riwayat Parkir</span>
                    </a>
                </li>
            </ul>

            <div class="absolute bottom-5 left-0 w-full px-3">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="flex items-center p-3 w-full text-gray-400 rounded-xl hover:bg-red-500/10 hover:text-red-500 transition">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span class="ms-3">Keluar Sistem</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
        <nav class="bg-white border border-gray-100 rounded-2xl p-4 mb-6 shadow-sm flex items-center justify-between">
            <button data-drawer-target="sidebar" onclick="toggleSidebar()"
                class="p-2 text-gray-600 rounded-lg sm:hidden hover:bg-gray-100">
                <i class="fas fa-bars"></i>
            </button>
            <div class="flex items-center space-x-4 ml-auto">
                <div class="text-right hidden sm:block">
                    <p class="text-xs font-bold text-gray-900">{{ Auth::user()->nama_user }}</p>
                    <p class="text-[10px] text-red-600 font-bold uppercase">Petugas Satpam</p>
                </div>
                <div class="w-10 h-10 bg-gray-200 rounded-full border-2 border-red-100 overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama_user) }}&background=E11D48&color=fff"
                        alt="">
                </div>
            </div>
        </nav>

        <div class="container mx-auto">
            @yield('content')
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }
    </script>
</body>

</html>
