<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f0f2f0] flex justify-center items-center min-h-screen p-5 font-sans">
  <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-lg mx-4">
    <div class="text-center mb-8">
      <h1 class="text-2xl font-semibold text-[#50675d] mb-2">Create Account</h1>
      <p class="text-gray-600 text-sm">Sign up to get started with our service</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
      @csrf
      
      <!-- Name -->
      <div class="mb-6">
        <label for="name" class="block mb-2 font-semibold text-[#50675d] text-sm">Name</label>
        <input
          id="name"
          name="name"
          type="text"
          value="{{ old('name') }}"
          required
          autofocus
          autocomplete="name"
          class="w-full px-4 py-3 border border-gray-300 rounded-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#50675d] focus:border-[#50675d]"
        />
        @if($errors->get('name'))
          <span class="text-red-600 text-xs mt-1 block">{{ $errors->get('name')[0] }}</span>
        @endif
      </div>

      <!-- Email -->
      <div class="mb-6">
        <label for="email" class="block mb-2 font-semibold text-[#50675d] text-sm">Email</label>
        <input
          id="email"
          name="email"
          type="email"
          value="{{ old('email') }}"
          required
          autocomplete="username"
          class="w-full px-4 py-3 border border-gray-300 rounded-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#50675d] focus:border-[#50675d]"
        />
        @if($errors->get('email'))
          <span class="text-red-600 text-xs mt-1 block">{{ $errors->get('email')[0] }}</span>
        @endif
      </div>

      <!-- Password -->
      <div class="mb-6">
        <label for="password" class="block mb-2 font-semibold text-[#50675d] text-sm">Password</label>
        <input
          id="password"
          name="password"
          type="password"
          required
          autocomplete="new-password"
          class="w-full px-4 py-3 border border-gray-300 rounded-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#50675d] focus:border-[#50675d]"
        />
        <p class="text-gray-500 text-xs mt-1">Password must be at least 8 characters</p>
        @if($errors->get('password'))
          <span class="text-red-600 text-xs mt-1 block">{{ $errors->get('password')[0] }}</span>
        @endif
      </div>

      <!-- Confirm Password -->
      <div class="mb-6">
        <label for="password_confirmation" class="block mb-2 font-semibold text-[#50675d] text-sm">Confirm Password</label>
        <input
          id="password_confirmation"
          name="password_confirmation"
          type="password"
          required
          autocomplete="new-password"
          class="w-full px-4 py-3 border border-gray-300 rounded-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#50675d] focus:border-[#50675d]"
        />
        @if($errors->get('password_confirmation'))
          <span class="text-red-600 text-xs mt-1 block">{{ $errors->get('password_confirmation')[0] }}</span>
        @endif
      </div>

      <div class="flex justify-between items-center">
        <a href="{{ route('login') }}" class="text-gray-600 text-sm hover:text-[#50675d] hover:underline">
          Already registered?
        </a>
        <button
          type="submit"
          class="bg-[#50675d] hover:bg-[#29462d] text-white font-semibold py-3 px-6 rounded-md transition-transform transform hover:-translate-y-1"
        >
          Register
        </button>
      </div>
    </form>
  </div>
</body>
</html>
