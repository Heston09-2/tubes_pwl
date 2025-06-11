<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f0f2f1] flex justify-center items-center min-h-screen p-5">
  <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
    <div class="text-center mb-8">
      <h1 class="text-3xl font-semibold text-[#50675d] tracking-wide">Login</h1>
    </div>

    <!-- Session Status -->
    @if (session('status'))
      <div class="bg-green-100 text-green-700 p-3 rounded mb-6 text-center">
        {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <!-- Email Address -->
      <div class="mb-6">
        <label for="email" class="block mb-2 font-semibold text-[#50675d] text-sm">Email</label>
        <input
          id="email"
          name="email"
          type="email"
          value="{{ old('email') }}"
          required
          autofocus
          autocomplete="username"
          class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#50675d] focus:border-[#50675d]"
        />
        @error('email')
          <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Password -->
      <div class="mb-6">
        <label for="password" class="block mb-2 font-semibold text-[#50675d] text-sm">Password</label>
        <input
          id="password"
          name="password"
          type="password"
          required
          autocomplete="current-password"
          class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#50675d] focus:border-[#50675d]"
        />
        @error('password')
          <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Remember Me -->
      <div class="flex items-center mb-6">
        <input
          id="remember_me"
          name="remember"
          type="checkbox"
          class="h-4 w-4 text-[#50675d] focus:ring-[#29462d] border-gray-300 rounded"
        />
        <label for="remember_me" class="ml-2 block text-sm text-gray-600">Remember me</label>
      </div>

      <button
        type="submit"
        class="w-full bg-[#50675d] hover:bg-[#29462d] text-white font-semibold py-3 rounded-md transition-transform transform hover:-translate-y-1"
      >
        Log in
      </button>
    </form>
  </div>
</body>
</html>
