<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register Pelajar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-md w-full max-w-md p-8">
        <h1 class="text-2xl font-bold text-center text-sky-700 mb-6">Register Pelajar</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('pelajar.register') }}" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input
                    type="text" name="name" id="name" value="{{ old('name') }}"
                    required
                    class="mt-1 block w-full rounded-md border @error('name') border-red-500 @else border-gray-300 @enderror shadow-sm focus:border-sky-500 focus:ring focus:ring-sky-300 focus:ring-opacity-50"
                >
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input
                    type="email" name="email" id="email" value="{{ old('email') }}"
                    required
                    class="mt-1 block w-full rounded-md border @error('email') border-red-500 @else border-gray-300 @enderror shadow-sm focus:border-sky-500 focus:ring focus:ring-sky-300 focus:ring-opacity-50"
                >
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input
                    type="password" name="password" id="password" required
                    class="mt-1 block w-full rounded-md border @error('password') border-red-500 @else border-gray-300 @enderror shadow-sm focus:border-sky-500 focus:ring focus:ring-sky-300 focus:ring-opacity-50"
                >
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input
                    type="password" name="password_confirmation" id="password_confirmation" required
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:ring focus:ring-sky-300 focus:ring-opacity-50"
                >
            </div>

            <div>
                <label for="umur" class="block text-sm font-medium text-gray-700">Umur</label>
                <input
                    type="number" name="umur" id="umur" value="{{ old('umur') }}" min="5" max="100" required
                    class="mt-1 block w-full rounded-md border @error('umur') border-red-500 @else border-gray-300 @enderror shadow-sm focus:border-sky-500 focus:ring focus:ring-sky-300 focus:ring-opacity-50"
                >
                @error('umur')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="pendidikan" class="block text-sm font-medium text-gray-700">Pendidikan</label>
                <select
                    name="pendidikan" id="pendidikan" required
                    class="mt-1 block w-full rounded-md border @error('pendidikan') border-red-500 @else border-gray-300 @enderror shadow-sm focus:border-sky-500 focus:ring focus:ring-sky-300 focus:ring-opacity-50"
                >
                    <option value="">-- Pilih Pendidikan --</option>
                    <option value="SD" {{ old('pendidikan') == 'SD' ? 'selected' : '' }}>SD</option>
                    <option value="SMP" {{ old('pendidikan') == 'SMP' ? 'selected' : '' }}>SMP</option>
                    <option value="SMA" {{ old('pendidikan') == 'SMA' ? 'selected' : '' }}>SMA</option>
                </select>
                @error('pendidikan')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Minat Sejarahmu</label>
                <div class="space-y-2 max-h-48 overflow-auto border rounded-md p-3 bg-gray-50">
                    @foreach($minats as $minat)
                        <label class="inline-flex items-center space-x-2">
                            <input
                                type="checkbox" name="minat[]" value="{{ $minat->id }}"
                                {{ (is_array(old('minat')) && in_array($minat->id, old('minat'))) ? 'checked' : '' }}
                                class="form-checkbox text-sky-600"
                            >
                            <span class="text-gray-700">{{ $minat->name }}</span>
                        </label><br>
                    @endforeach
                </div>
                @error('minat')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                class="w-full py-2 px-4 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-md shadow-sm transition"
            >
                Register
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600">
            Sudah punya akun? 
            <a href="{{ route('pelajar.login') }}" class="text-sky-600 hover:underline font-semibold">Login di sini</a>
        </p>
    </div>
</body>
</html>
