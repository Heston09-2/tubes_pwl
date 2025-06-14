<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register Pelajar</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">

  <div class="bg-white rounded-xl shadow-lg w-full max-w-xl p-10 border border-gray-100 space-y-6">

    <h1 class="text-3xl font-semibold text-center text-sky-700">Daftar Akun Pelajar</h1>

    @if ($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
        <ul class="list-disc list-inside text-sm">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('pelajar.register') }}" class="space-y-5">
      @csrf

      <div>
        <label for="name" class="block text-base font-medium text-gray-700 mb-1">Nama</label>
        <input
          type="text" name="name" id="name" value="{{ old('name') }}" required
          class="w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring focus:ring-sky-200 text-base py-2.5 px-3"
        />
        @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
      </div>

      <div>
        <label for="email" class="block text-base font-medium text-gray-700 mb-1">Email</label>
        <input
          type="email" name="email" id="email" value="{{ old('email') }}" required
          class="w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring focus:ring-sky-200 text-base py-2.5 px-3"
        />
        @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label for="password" class="block text-base font-medium text-gray-700 mb-1">Password</label>
          <input
            type="password" name="password" id="password" required
            class="w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring focus:ring-sky-200 text-base py-2.5 px-3"
          />
          @error('password')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
          <label for="password_confirmation" class="block text-base font-medium text-gray-700 mb-1">Konfirmasi Password</label>
          <input
            type="password" name="password_confirmation" id="password_confirmation" required
            class="w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring focus:ring-sky-200 text-base py-2.5 px-3"
          />
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label for="umur" class="block text-base font-medium text-gray-700 mb-1">Umur</label>
          <input
            type="number" name="umur" id="umur" value="{{ old('umur') }}" min="5" max="100" required
            class="w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring focus:ring-sky-200 text-base py-2.5 px-3"
          />
          @error('umur')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
          <label for="pendidikan" class="block text-base font-medium text-gray-700 mb-1">Pendidikan</label>
          <select
            name="pendidikan" id="pendidikan" required
            class="w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring focus:ring-sky-200 text-base py-2.5 px-3"
          >
            <option value="">-- Pilih Pendidikan --</option>
            <option value="SD" {{ old('pendidikan') == 'SD' ? 'selected' : '' }}>SD</option>
            <option value="SMP" {{ old('pendidikan') == 'SMP' ? 'selected' : '' }}>SMP</option>
            <option value="SMA" {{ old('pendidikan') == 'SMA' ? 'selected' : '' }}>SMA</option>
          </select>
          @error('pendidikan')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
      </div>

      <div>
        <label class="block text-base font-medium text-gray-700 mb-2">Pilih Minat Sejarahmu</label>
        <div class="space-y-2 max-h-48 overflow-auto border rounded-md p-3 bg-gray-50 text-base">
          @foreach($minats as $minat)
            <label class="inline-flex items-center space-x-2">
              <input
                type="checkbox" name="minat[]" value="{{ $minat->id }}"
                {{ (is_array(old('minat')) && in_array($minat->id, old('minat'))) ? 'checked' : '' }}
                class="text-sky-600 focus:ring-sky-500 rounded"
              />
              <span>{{ $minat->name }}</span>
            </label><br>
          @endforeach
        </div>
        @error('minat')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
      </div>

      <button
        type="submit"
        class="w-full py-3 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-md shadow-sm transition duration-200 text-base"
      >
        Daftar Sekarang
      </button>
    </form>

    <p class="text-center text-sm text-gray-600 mt-4">
      Sudah punya akun?
      <a href="{{ route('pelajar.login') }}" class="text-sky-600 hover:underline font-medium">Login di sini</a>
    </p>
  </div>

</body>
</html>
