<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Selamat Datang Pelajar - Flows Museum</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center relative overflow-hidden p-4">

  <!-- Background Biru Muda Atas -->
  <div class="absolute top-0 left-0 w-3/4 h-64 bg-blue-100 rounded-b-full opacity-50 -z-10"></div>

  <!-- Background Biru Muda Bawah -->
  <div class="absolute bottom-0 right-0 w-3/4 h-64 bg-blue-100 rounded-t-full opacity-50 -z-10"></div>

  <div class="container max-w-2xl mx-auto text-center p-10 bg-white shadow-md rounded-xl border border-gray-100">
    
    <h1 class="text-4xl md:text-5xl font-semibold text-gray-800 mb-4 tracking-tight">
      Selamat Datang di <span class="text-blue-500">Flows Museum Pelajar</span>
    </h1>
    
    <p class="text-lg text-gray-600 mb-10 leading-relaxed max-w-lg mx-auto">
      Temukan berbagai materi pembelajaran sesuai minat kamu dan jelajahi dunia pengetahuan!
    </p>
    
    <div class="flex flex-col sm:flex-row justify-center gap-4 mb-10">
      <a href="{{ route('pelajar.login') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-8 py-3 rounded-md transition duration-200 text-sm tracking-wide">
        Login
      </a>
      <a href="{{ route('pelajar.register') }}" class="border border-blue-200 text-blue-600 hover:bg-blue-50 font-medium px-8 py-3 rounded-md transition duration-200 text-sm tracking-wide">
        Register
      </a>
      <a href="{{ route('welcome') }}" class="text-gray-500 hover:text-gray-700 font-medium px-8 py-3 rounded-md transition duration-200 text-sm tracking-wide">
        Kembali ke Museum
      </a>
    </div>
    
    <footer class="text-xs text-gray-400 mt-8 pt-6 border-t border-gray-100 font-light tracking-wide">
      &copy; {{ date('Y') }} Flows Museum - Semua Hak Dilindungi
    </footer>
  </div>

</body>
</html>
