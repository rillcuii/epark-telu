<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Park Satpam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    },
                    colors: {
                        figmaRed: '#EE2B2B',
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }

        /* Header lengkung bawah sesuai Figma */
        .header-curved {
            border-bottom-left-radius: 45px;
            border-bottom-right-radius: 45px;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans antialiased overflow-x-hidden">

    <div class="flex justify-center min-h-screen">
        <div class="w-full max-w-[430px] bg-white shadow-2xl relative min-h-screen flex flex-col overflow-hidden">

            <div id="sidebar"
                class="fixed inset-y-0 left-0 w-[340px] bg-white z-[80] sidebar-transition -translate-x-full flex flex-col">
                <div class="p-8 flex items-center gap-4 mt-10">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama_user) }}&background=f3f4f6&color=EE2B2B&bold=true"
                        class="w-14 h-14 rounded-full border border-gray-100">
                    <div>
                        <h3 class="text-base font-bold text-gray-900 leading-tight">{{ Auth::user()->nama_user }}</h3>
                        <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider">
                            Satpam • {{ Auth::user()->id_user}}
                        </p>
                    </div>
                </div>

                <div class="px-8">
                    <hr class="border-gray-100">
                </div>

                <nav class="flex-grow p-6 space-y-2">
                    <a href="{{ route('satpam.dashboard') }}"
                        class="flex items-center gap-5 p-4 {{ Request::is('satpam/dashboard') ? 'text-figmaRed' : 'text-gray-400' }}">
                        <i class="fas fa-home text-2xl"></i>
                        <span
                            class="text-lg font-bold {{ Request::is('satpam/dashboard') ? '' : 'text-gray-800' }}">Home</span>
                    </a>
                    <a href="{{ route('satpam.riwayat_parkir') }}"
                        class="flex items-center gap-5 p-4 {{ Request::is('satpam/riwayat*') ? 'text-figmaRed' : 'text-gray-400' }}">
                        <i class="fas fa-history text-2xl"></i>
                        <span
                            class="text-lg font-bold {{ Request::is('satpam/riwayat*') ? '' : 'text-gray-800' }}">Riwayat
                            Parkir</span>
                    </a>
                </nav>

                <div class="p-8 border-t border-gray-100 mb-6">
                    <button onclick="showLogoutModal()" class="flex items-center gap-5 text-figmaRed font-bold">
                        <i class="fas fa-sign-out-alt text-2xl rotate-180"></i>
                        <span class="text-lg">Log Out</span>
                    </button>
                </div>
            </div>

            <div id="overlay" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-[70] hidden"
                onclick="closeSidebar()"></div>

            <header class="bg-figmaRed h-32 w-full p-8 relative header-curved shadow-lg z-10 flex items-start">
                <div class="flex items-center gap-4 cursor-pointer group transition active:scale-95"
                    onclick="toggleSidebar()">
                    <div
                        class="w-12 h-12 bg-white/20 rounded-full border border-white/30 backdrop-blur-md overflow-hidden group-hover:border-white/60">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama_user) }}&background=fff&color=EE2B2B&bold=true"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="text-white">
                        <h3 class="text-sm font-bold leading-tight">{{ Auth::user()->nama_user }}</h3>
                        <p class="text-[10px] font-medium opacity-80 uppercase tracking-widest">
                            Satpam • {{ Auth::user()->id_user }}
                        </p>
                    </div>
                </div>
            </header>

            <main class="flex-grow px-8 -mt-6 pb-10 relative z-20">
                @yield('content')
            </main>

            <div id="logoutModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-6">
                <div class="fixed inset-0 bg-black/40 backdrop-blur-sm" onclick="hideLogoutModal()"></div>
                <div class="relative bg-white w-full max-w-[300px] rounded-[35px] p-8 shadow-2xl text-center">
                    <h4 class="text-xl font-extrabold text-gray-900 mb-2">Peringatan</h4>
                    <p class="text-sm text-gray-500 font-medium mb-10">Yakin Ingin Keluar Dari aplikasi?</p>
                    <div class="grid grid-cols-2 gap-4">
                        <button onclick="hideLogoutModal()"
                            class="py-3 bg-gray-200 text-gray-900 rounded-xl font-bold text-sm">Tidak</button>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full py-3 bg-figmaRed text-white rounded-xl font-bold text-sm shadow-lg shadow-figmaRed/30">Ya</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const logoutModal = document.getElementById('logoutModal');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }

        function showLogoutModal() {
            logoutModal.classList.remove('hidden');
        }

        function hideLogoutModal() {
            logoutModal.classList.add('hidden');
        }
    </script>
</body>

</html>
