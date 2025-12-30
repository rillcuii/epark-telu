<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mahasiswa - EPARK-TELU</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-3xl shadow-xl w-full max-w-md">
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center">
                    <span class="text-white text-2xl font-bold">E</span>
                </div>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Selamat Datang</h1>
            <p class="text-gray-500">Silakan pilih metode login yang sesuai dengan peran anda untuk masuk ke DIGIPARK-TELU</p>
        </div>

        <form action="#" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="username">
                    Username / NIM
                </label>
                <input class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-blue-500 focus:bg-white focus:outline-none transition duration-200" 
                       type="text" id="username" name="username" placeholder="Masukkan NIM" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="password">
                    Password
                </label>
                <input class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-blue-500 focus:bg-white focus:outline-none transition duration-200" 
                       type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <div class="flex items-center justify-between mb-6 text-sm">
                <label class="flex items-center text-gray-600">
                    <input type="checkbox" class="mr-2 rounded border-gray-300"> Ingat saya
                </label>
                <a href="#" class="text-blue-600 hover:underline font-medium">Lupa password?</a>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg transition duration-300 transform hover:-translate-y-0.5">
                Masuk
            </button>
        </form>

        <div class="mt-8 text-center text-sm text-gray-500">
            Belum punya akun? <a href="#" class="text-blue-600 font-bold hover:underline">Daftar Sekarang</a>
        </div>
    </div>

</body>
</html>