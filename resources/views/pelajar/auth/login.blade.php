<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login Pelajar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-md w-full max-w-md p-6">
        <h1 class="text-2xl font-bold text-center text-sky-700 mb-5">Login Pelajar</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5" role="alert">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('pelajar.login') }}" class="space-y-5 text-sm">
            @csrf

            <div>
                <label for="email" class="block font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full rounded-md border border-gray-500 bg-white shadow-sm py-2.5 px-3 focus:border-sky-500 focus:ring focus:ring-sky-200" />
            </div>

            <div>
                <label for="password" class="block font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full rounded-md border border-gray-500 bg-white shadow-sm py-2.5 px-3 focus:border-sky-500 focus:ring focus:ring-sky-200" />
            </div>

            <button type="submit"
                class="w-full py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-md shadow-sm transition">
                Login
            </button>
        </form>

        <p class="mt-5 text-center text-gray-600 text-sm">
            Belum punya akun?
            <a href="{{ route('pelajar.register') }}" class="text-sky-600 hover:underline font-semibold">Daftar di sini</a>
        </p>
    </div>
</body>
</html>
