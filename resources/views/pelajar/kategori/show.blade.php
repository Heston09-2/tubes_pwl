@extends('pelajar.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-sky-50 to-blue-100">
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="bg-white/70 backdrop-blur-sm rounded-2xl shadow-sm border border-blue-100 p-8 mb-8">
            <h1 class="text-3xl font-light mb-2 text-slate-800 tracking-wide">
                Subkategori dari:
            </h1>
            <div class="text-2xl font-semibold text-blue-600 flex items-center">
                <div class="w-1 h-8 bg-gradient-to-b from-blue-400 to-sky-500 rounded-full mr-4"></div>
                {{ $category->name }}
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white/60 backdrop-blur-sm rounded-xl shadow-sm border border-blue-100 p-6 mb-8">
            <form method="GET" action="{{ route('pelajar.kategori.show', $category->id) }}">
                <label for="subcategory_id" class="block text-sm font-medium text-slate-700 mb-3 tracking-wide">
                    Filter berdasarkan subkategori:
                </label>
                <div class="relative">
                    <select name="subcategory_id" id="subcategory_id" onchange="this.form.submit()" 
                            class="w-full md:w-auto px-6 py-3 bg-white border border-blue-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition-all duration-200 text-slate-700 font-medium appearance-none cursor-pointer hover:bg-blue-50">
                        <option value="">Semua Subkategori</option>
                        @foreach ($categorySubcategories as $subcategory)
                            <option value="{{ $subcategory->id }}" {{ $filterId == $subcategory->id ? 'selected' : '' }}>
                                {{ $subcategory->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </form>
        </div>

        <!-- Subcategories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($subcategories as $subcategory)
                <a href="{{ route('pelajar.materi.detail', $subcategory->id) }}"
                   class="group block bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-blue-100 p-8 transition-all duration-300 hover:shadow-lg hover:shadow-blue-200/50 hover:-translate-y-1 hover:bg-white/90 hover:border-blue-200">
                    
                    <!-- Card Header -->
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-3 h-3 bg-gradient-to-r from-blue-400 to-sky-500 rounded-full flex-shrink-0 mt-1"></div>
                        <div class="ml-4 flex-1">
                            <h2 class="text-xl font-semibold text-slate-800 group-hover:text-blue-600 transition-colors duration-200 leading-tight">
                                {{ $subcategory->name }}
                            </h2>
                        </div>
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Card Content -->
                    <div class="pl-7">
                        <p class="text-slate-600 leading-relaxed text-sm">
                            {{ $subcategory->description ?? 'Tidak ada deskripsi tersedia untuk subkategori ini.' }}
                        </p>
                        
                        <!-- Card Footer -->
                        <div class="mt-6 pt-4 border-t border-blue-100/50">
                            <span class="inline-flex items-center text-xs font-medium text-blue-600 group-hover:text-blue-700 transition-colors">
                                Lihat Detail
                                <svg class="w-3 h-3 ml-1 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full">
                    <div class="bg-white/60 backdrop-blur-sm rounded-xl border border-blue-100 p-12 text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <p class="text-slate-500 text-lg font-medium mb-2">Tidak ada subkategori ditemukan</p>
                        <p class="text-slate-400 text-sm">Tidak ada subkategori yang sesuai dengan filter yang dipilih.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection