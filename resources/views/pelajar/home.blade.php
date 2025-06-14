@extends('pelajar.layouts.app')

{{-- Tambah CSS untuk smooth scroll --}}
@push('styles')
<style>
    html {
        scroll-behavior: smooth;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-blue-50 via-sky-50 to-blue-100 rounded-3xl overflow-hidden shadow-lg mb-12">
    <div class="absolute inset-0 bg-gradient-to-r from-blue-600/5 to-sky-600/5"></div>

    <div class="relative flex flex-col lg:flex-row items-center min-h-[500px] px-8 py-12">
        <div class="flex-1 lg:pr-12 text-center lg:text-left">
            <h1 class="text-4xl lg:text-5xl font-light mb-6 text-slate-800 leading-tight">
                Selamat Datang di 
                <span class="font-semibold text-blue-600">Flows Museum</span>
            </h1>
            <p class="text-lg text-slate-600 mb-8 leading-relaxed max-w-xl">
                Jelajahi perjalanan sejarah dengan pendekatan visual yang menarik dan konten berkualitas tinggi.
            </p>
            <div class="flex justify-center lg:justify-start space-x-4">
                <a href="#categories" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700 transition-colors duration-200 shadow-md hover:shadow-lg">
                    Mulai Belajar
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
                <a href="#latest" class="inline-flex items-center px-6 py-3 border-2 border-blue-600 text-blue-600 rounded-xl font-medium hover:bg-blue-50 transition-colors duration-200">
                    Lihat Materi
                </a>
            </div>
        </div>

        <div class="flex-1 mt-8 lg:mt-0 flex justify-center lg:justify-end">
            <div class="relative w-full max-w-md">
                <div class="relative bg-transparent p-0 shadow-none border-none">
                    <div class="w-full h-90 relative overflow-hidden rounded-xl">
                        <img src="/image/sejarah.png" alt="Ilustrasi Orang Belajar" class="w-full h-full object-cover" />
                    </div>
                    <div class="absolute -top-4 -right-4 w-8 h-8 bg-blue-500 rounded-full opacity-20"></div>
                    <div class="absolute -bottom-2 -left-2 w-6 h-6 bg-sky-500 rounded-full opacity-30"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Kategori Populer -->
<section id="categories" class="mb-16">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-light text-slate-800 mb-4">
            Kategori <span class="font-semibold text-blue-600">Populer</span>
        </h2>
        <div class="w-24 h-1 bg-blue-600 mx-auto rounded-full"></div>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($popularCategories as $category)
        <a href="{{ route('pelajar.kategori.show', $category->id) }}" class="group bg-white rounded-2xl shadow-sm hover:shadow-md border border-blue-100 hover:border-blue-200 p-6 text-center transition-all duration-200 hover:-translate-y-1">
            <div class="w-12 h-12 bg-blue-100 rounded-xl mx-auto mb-4 flex items-center justify-center group-hover:bg-blue-600 transition-colors duration-200">
                <svg class="w-6 h-6 text-blue-600 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-slate-800 mb-2">{{ $category->name }}</h3>
            <p class="text-sm text-slate-500">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs bg-blue-50 text-blue-700 border border-blue-200">
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
    <div class="text-center mb-12">
        <h2 class="text-3xl font-light text-slate-800 mb-4">
            Kategori Sesuai <span class="font-semibold text-blue-600">Minatmu</span>
        </h2>
        <div class="w-24 h-1 bg-blue-600 mx-auto rounded-full"></div>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($minatCategories as $category)
        <a href="{{ route('pelajar.kategori.show', $category->id) }}" class="group relative bg-gradient-to-br from-blue-50 to-sky-50 rounded-2xl shadow-sm hover:shadow-md border-2 border-blue-200 hover:border-blue-300 p-6 text-center transition-all duration-200 hover:-translate-y-1 overflow-hidden">
            <div class="absolute top-2 right-2 w-3 h-3 bg-blue-500 rounded-full"></div>
            <div class="w-12 h-12 bg-blue-600 rounded-xl mx-auto mb-4 flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-slate-800 mb-2">{{ $category->name }}</h3>
            <p class="text-sm text-slate-600">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-700 border border-blue-200">
                    {{ $category->materials_count }} materi
                </span>
            </p>
        </a>
        @endforeach
    </div>
</section>
@endif

<!-- Materi Terbaru -->
<section id="latest">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-light text-slate-800 mb-4">
            Materi <span class="font-semibold text-blue-600">Terbaru</span>
        </h2>
        <div class="w-24 h-1 bg-blue-600 mx-auto rounded-full"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($latestMaterials as $material)
        <div class="group bg-white rounded-2xl shadow-sm hover:shadow-lg border border-blue-100 hover:border-blue-200 p-6 transition-all duration-200 hover:-translate-y-1">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center group-hover:bg-blue-600 transition-colors duration-200">
                    <svg class="w-5 h-5 text-blue-600 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <span class="text-xs text-slate-500 bg-slate-100 px-3 py-1 rounded-full">
                    {{ $material->created_at->format('d M Y') }}
                </span>
            </div>
            <h2 class="text-xl font-medium text-slate-800 mb-3 line-clamp-2">
                {{ $material->title }}
            </h2>
            <div class="flex items-center text-sm text-slate-600 mb-6">
                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a.997.997 0 01-1.414 0l-7-7A1.997 1.997 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                <span>{{ $material->category->name }}</span>
            </div>
            <a href="{{ route('pelajar.materi.show', $material->id) }}" class="inline-flex items-center text-blue-600 font-medium hover:text-blue-700 transition-colors duration-200">
                <span>Baca Selengkapnya</span>
                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
        @endforeach
    </div>
</section>

<!-- Tombol Hubungi Kami -->
<div class="fixed bottom-6 right-6 z-50">
    <a href="{{ route('pelajar.contact.form') }}">
        <button class="w-12 h-12 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center" title="Hubungi Kami">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </button>
    </a>
</div>
@endsection
