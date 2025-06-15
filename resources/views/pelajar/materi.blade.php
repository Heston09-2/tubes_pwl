@extends('pelajar.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50/30">
    <div class="container mx-auto py-8 px-4 max-w-7xl">
        
        <!-- Header Section -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100/80 rounded-2xl mb-4">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Kategori Materi</h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">Jelajahi berbagai kategori pembelajaran yang tersedia</p>
        </div>

        <!-- Filter Section -->
        <div class="flex justify-center mb-10">
            <form method="GET" action="{{ route('pelajar.materi') }}" class="w-full max-w-md">
                <div class="relative">
                    <select name="category" onchange="this.form.submit()" 
                            class="w-full px-5 py-3 bg-white border border-gray-200 rounded-xl text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 transition-all duration-200 appearance-none cursor-pointer">
                        <option value="">Semua Kategori</option>
                        @foreach ($allCategories as $cat)
                            <option value="{{ $cat->id }}" {{ $selectedCategoryId == $cat->id ? 'selected' : '' }}>
                                {{ ucfirst($cat->name) }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </form>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($categories as $category)
                <a href="{{ route('pelajar.kategori.show', $category->id) }}" 
                   class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/10 hover:-translate-y-1 hover:border-blue-200">
                    
                    <!-- Image Container -->
                    <div class="relative overflow-hidden">
                        @if ($category->randomImage)
                            <div class="w-full h-48 bg-gray-50">
                                <img src="{{ asset('storage/images' . $category->randomImage) }}" 
                                     alt="{{ $category->name }}"
                                     class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                            </div>
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-blue-50 to-slate-100 flex items-center justify-center">
                                <div class="text-center">
                                    <svg class="w-12 h-12 text-blue-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-sm text-blue-400 font-medium">Tidak ada gambar</p>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2 group-hover:text-blue-600 transition-colors duration-200">
                            {{ $category->name }}
                        </h2>
                        <p class="text-gray-500 text-sm mb-4">Lihat subkategori & materi</p>
                        
                        <!-- Action Indicator -->
                        <div class="flex items-center text-blue-600 text-sm font-medium">
                            <span class="mr-2">Jelajahi</span>
                            <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full">
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Tidak ada kategori ditemukan</h3>
                        <p class="text-gray-500">Coba ubah filter atau periksa kembali nanti</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection