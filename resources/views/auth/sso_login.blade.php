<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login SSO - DigiPark Tel-U</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-dvh w-screen overflow-hidden flex justify-center items-center bg-gray-100">
    <form action="{{ route('proses.login') }}" method="POST" class="h-full w-full flex justify-center">
        @csrf
        <input hidden type="text" name="username" value="rizky_mhs">
        <input hidden type="password" name="password" value="password123">

        <button type="submit" class="h-full w-auto p-0 border-none bg-transparent flex items-center">
            <img src="{{ asset('assets/images/login_sso.png') }}" alt="Login SSO Example"
                class="h-full w-auto object-contain block">
        </button>
    </form>
</body>

</html>
