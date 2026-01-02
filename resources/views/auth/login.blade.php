<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DigiPark Tel-U</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Card Container -->
        <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
            <!-- Header with Logo -->
            <div class="bg-gray-200 px-6 py-12 flex justify-center">
                <div class="text-center">
                    <div class="flex items-center justify-center mb-2">
                        <!-- Logo simplified representation -->
                        <div class="relative">
                            <div class="w-16 h-16 bg-gray-600 rounded-full"></div>
                            <div class="absolute top-0 left-0 w-16 h-8 bg-red-600 rounded-t-full"></div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h1 class="text-3xl font-bold text-gray-800">DigiPark</h1>
                        <p class="text-xl text-gray-600">Tel-U</p>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="px-6 py-8">
                <h2 class="text-2xl font-bold text-center mb-2">Selamat Datang</h2>
                <p class="text-center text-sm text-gray-600 mb-8">
                    Silakan pilih metode login yang sesuai dengan peran anda untuk masuk ke DigiPark Tel-U
                </p>

                @if (session('error'))
                    <div
                        class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6 text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('proses.login') }}" method="POST">
                    @csrf
                    <!-- Username Field -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Username
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input type="text" name="username" value="{{ old('username') }}" placeholder="Username"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input type="password" name="password" placeholder="Password"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Login Button -->
                    <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-lg transition duration-200 mb-4">
                        Masuk
                    </button>
                </form>

                <!-- Divider -->
                <div class="text-center text-sm text-gray-500 mb-4">
                    atau login dengan
                </div>

                <!-- SSO Login Button -->
                <a href="{{ route('login.sso') }}"
                    class="block w-full text-center bg-white border-2 border-red-600 text-red-600 hover:bg-red-50 font-semibold py-3 rounded-lg transition duration-200">
                    Login SSO (Mahasiswa)
                </a>

                <!-- Help Link -->
                <div class="text-center mt-6 text-sm">
                    <span class="text-gray-600">Butuh bantuan ? </span>
                    <a href="#" class="text-blue-600 hover:underline font-medium">
                        Hubungi Service Desk
                    </a>
                    <span class="ml-1">📞</span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
