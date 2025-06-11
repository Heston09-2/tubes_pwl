@extends('pelajar.layouts.app')

@section('content')
    <!-- Hero / Banner -->
    <div class="relative bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 text-white rounded-2xl overflow-hidden shadow-2xl mb-10 group">
        @if($randomMaterial && $randomMaterial->image)
            <img src="{{ asset('storage/' . $randomMaterial->image) }}" alt="Gambar Sejarah" class="w-full h-64 object-cover opacity-30 group-hover:opacity-40 transition-opacity duration-500">
        @else
            <div class="w-full h-64 bg-gradient-to-r from-blue-900/50 to-purple-900/50 opacity-40"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
        <div class="absolute inset-0 flex flex-col justify-center items-center px-6">
            <h1 class="text-5xl font-bold mb-4 text-center bg-gradient-to-r from-blue-200 to-purple-200 bg-clip-text text-transparent animate-pulse">
                Selamat Datang di Flows Museum
            </h1>
            <p class="text-xl text-center text-gray-200 max-w-2xl leading-relaxed">
                Belajar sejarah dengan visual menarik dan konten terkurasi.
            </p>
            <div class="mt-6 flex space-x-2">
                <div class="w-2 h-2 bg-blue-400 rounded-full animate-bounce"></div>
                <div class="w-2 h-2 bg-purple-400 rounded-full animate-bounce" style="animation-delay: 0.1s;"></div>
                <div class="w-2 h-2 bg-pink-400 rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
            </div>
        </div>
    </div>
    <a href="{{ route('pelajar.quizzes.index') }}" class="block text-blue-600 hover:underline">
    📘 Ikuti Kuis
</a>


    <!-- Kategori Populer -->
    <section class="mb-16">
        <div class="flex items-center mb-8">
            <div class="flex-1 h-px bg-gradient-to-r from-transparent via-blue-300 to-transparent"></div>
            <h2 class="text-3xl font-bold mx-6 text-gray-800 relative">
                <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    Kategori Populer
                </span>
                <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-16 h-1 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full"></div>
            </h2>
            <div class="flex-1 h-px bg-gradient-to-r from-transparent via-purple-300 to-transparent"></div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($popularCategories as $category)
                <a href="{{ route('pelajar.kategori.show', $category->id) }}" 
                   class="group bg-white/80 backdrop-blur-sm shadow-lg hover:shadow-2xl p-6 rounded-2xl text-center transform hover:scale-105 transition-all duration-300 border border-gray-100 hover:border-blue-200">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl mx-auto mb-4 flex items-center justify-center group-hover:rotate-12 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent group-hover:from-purple-600 group-hover:to-pink-600 transition-all duration-300">
                        {{ $category->name }}
                    </h3>
                    <p class="text-sm text-gray-500 mt-2 group-hover:text-gray-600 transition-colors">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-800 group-hover:bg-blue-200">
                            {{ $category->materials_count }} materi
                        </span>
                    </p>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Kategori Berdasarkan Minat -->
    @if($minatCategories->isNotEmpty())
    <section class="mb-16">
        <div class="flex items-center mb-8">
            <div class="flex-1 h-px bg-gradient-to-r from-transparent via-emerald-300 to-transparent"></div>
            <h2 class="text-3xl font-bold mx-6 text-gray-800 relative">
                <span class="bg-gradient-to-r from-emerald-600 to-blue-600 bg-clip-text text-transparent">
                    Kategori Sesuai Minatmu
                </span>
                <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-16 h-1 bg-gradient-to-r from-emerald-500 to-blue-500 rounded-full"></div>
            </h2>
            <div class="flex-1 h-px bg-gradient-to-r from-transparent via-blue-300 to-transparent"></div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($minatCategories as $category)
                <a href="{{ route('pelajar.kategori.show', $category->id) }}" 
                   class="group bg-gradient-to-br from-emerald-50 to-blue-50 shadow-lg hover:shadow-2xl p-6 rounded-2xl text-center border-2 border-gradient-to-r from-emerald-400 to-blue-500 hover:border-emerald-500 transform hover:scale-105 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-16 h-16 bg-gradient-to-br from-emerald-400/20 to-blue-400/20 rounded-full -mr-8 -mt-8"></div>
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-blue-600 rounded-xl mx-auto mb-4 flex items-center justify-center group-hover:rotate-12 transition-transform duration-300 relative z-10">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold bg-gradient-to-r from-emerald-600 to-blue-600 bg-clip-text text-transparent group-hover:from-blue-600 group-hover:to-purple-600 transition-all duration-300 relative z-10">
                        {{ $category->name }}
                    </h3>
                    <p class="text-sm text-gray-600 mt-2 group-hover:text-gray-700 transition-colors relative z-10">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-emerald-100 text-emerald-800 group-hover:bg-emerald-200">
                            {{ $category->materials_count }} materi
                        </span>
                    </p>
                </a>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Materi Terbaru -->
    <section>
        <div class="flex items-center mb-8">
            <div class="flex-1 h-px bg-gradient-to-r from-transparent via-purple-300 to-transparent"></div>
            <h2 class="text-3xl font-bold mx-6 text-gray-800 relative">
                <span class="bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    Materi Terbaru
                </span>
                <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-16 h-1 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full"></div>
            </h2>
            <div class="flex-1 h-px bg-gradient-to-r from-transparent via-pink-300 to-transparent"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($latestMaterials as $material)
                <div class="group bg-white/90 backdrop-blur-sm shadow-lg rounded-2xl p-6 hover:shadow-2xl transition-all duration-300 transform hover:scale-105 border border-gray-100 hover:border-purple-200 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-500 to-pink-500"></div>
                    <div class="absolute -top-4 -right-4 w-16 h-16 bg-gradient-to-br from-purple-400/10 to-pink-400/10 rounded-full"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center group-hover:rotate-12 transition-transform duration-300">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <span class="text-xs text-gray-400 bg-gray-100 px-2 py-1 rounded-full">
                                {{ $material->created_at->format('d M Y') }}
                            </span>
                        </div>
                        
                        <h2 class="text-xl font-bold bg-gradient-to-r from-purple-700 to-pink-600 bg-clip-text text-transparent mb-3 group-hover:from-pink-600 group-hover:to-purple-700 transition-all duration-300">
                            {{ $material->title }}
                        </h2>
                        
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a.997.997 0 01-1.414 0l-7-7A1.997 1.997 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                <span class="font-medium">{{ $material->category->name }}</span>
                            </div>
                        </div>
                        
                        <a href="{{ route('pelajar.materi.show', $material->id) }}" 
                           class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white text-sm font-semibold rounded-lg hover:from-pink-500 hover:to-purple-500 transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                            <span>Baca Selengkapnya</span>
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection