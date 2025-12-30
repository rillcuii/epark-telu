<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - E-Park</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.open {
                transform: translateX(0);
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 text-gray-800">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="sidebar w-64 bg-gradient-to-b from-slate-900 to-slate-800 text-white flex-shrink-0 shadow-2xl fixed md:static h-screen md:h-auto z-50 flex flex-col overflow-y-auto">
            <!-- Header -->
            <div class="p-6 border-b border-slate-700">
                <div class="flex items-center justify-between">
                    <div>
                        <h1
                            class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">
                            E-Park</h1>
                        <p class="text-xs text-gray-400 mt-1">Admin Panel</p>
                    </div>
                    <button onclick="toggleSidebar()" class="md:hidden text-gray-400 hover:text-white">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-2 flex-grow overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center p-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-500/50' : 'hover:bg-slate-700/50 text-gray-300 hover:text-white' }}">
                    <i
                        class="fas fa-home w-5 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }}"></i>
                    <span class="ml-3 font-medium">Dashboard</span>
                </a>

                <a href="{{ route('satpam.index') }}"
                    class="flex items-center p-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('satpam.*') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-500/50' : 'hover:bg-slate-700/50 text-gray-300 hover:text-white' }}">
                    <i
                        class="fas fa-user-shield w-5 {{ request()->routeIs('satpam.*') ? 'text-white' : 'text-green-400 group-hover:text-green-300' }}"></i>
                    <span class="ml-3 font-medium">Kelola Satpam</span>
                </a>

                <a href="{{ route('keluhan.index') }}"
                    class="flex items-center p-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('keluhan.*') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-500/50' : 'hover:bg-slate-700/50 text-gray-300 hover:text-white' }}">
                    <i
                        class="fas fa-exclamation-circle w-5 {{ request()->routeIs('keluhan.*') ? 'text-white' : 'text-yellow-400 group-hover:text-yellow-300' }}"></i>
                    <span class="ml-3 font-medium">Keluhan</span>
                </a>
            </nav>

            <!-- Logout Section -->
            <div class="p-4 border-t border-slate-700 mt-auto flex-shrink-0">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full p-3 text-red-400 hover:bg-red-500/10 rounded-lg transition-all duration-200 group hover:text-red-300">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span class="ml-3 font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Overlay for mobile -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"
            onclick="toggleSidebar()"></div>

        <!-- Main Content -->
        <main class="flex-grow flex flex-col min-h-screen md:ml-0">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm sticky top-0 z-30">
                <div class="flex items-center justify-between px-6 py-4">
                    <button onclick="toggleSidebar()" class="md:hidden text-gray-600 hover:text-gray-900">
                        <i class="fas fa-bars text-xl"></i>
                    </button>

                    <div class="flex items-center space-x-4 ml-auto">
                        <div class="hidden md:flex items-center space-x-3">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-full flex items-center justify-center text-white font-semibold">
                                A
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">Admin</p>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="flex-grow p-6 md:p-8">
                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 py-4 px-6">
                <p class="text-center text-sm text-gray-500">
                    © 2025 E-Park. All rights reserved.
                </p>
            </footer>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            sidebar.classList.toggle('open');
            overlay.classList.toggle('hidden');
        }

        // Close sidebar when clicking outside on mobile
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                document.getElementById('overlay').classList.add('hidden');
                document.getElementById('sidebar').classList.remove('open');
            }
        });
    </script>

</body>

</html>
