@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-4xl font-semibold text-[#4D5D53] text-center mb-10 relative inline-block pb-3">
        Gallery Karya Seni
        <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-20 h-1.5 bg-[#6B7A71] rounded"></span>
    </h1>

    <!-- Form filter dan search -->
    <form method="GET" action="{{ route('gallery') }}" class="bg-white p-6 rounded-lg shadow-md border-l-4 border-[#4D5D53] mb-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Filter Nama/Pembuat -->
            <div>
                <label for="search" class="block text-[#424242] font-medium mb-1">Nama/Pembuat</label>
                <input type="text" id="search" name="search" placeholder="Cari nama atau pembuat"
                    value="{{ request('search') }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#6B7A71] focus:border-[#6B7A71] text-gray-700" />
            </div>

            <!-- Filter Kategori -->
            <div>
    <label for="category" class="block text-[#424242] font-medium mb-1">Kategori</label>
    <select id="category" name="category"
        class="w-full border border-gray-300 rounded-md px-3 py-2 bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#6B7A71] focus:border-[#6B7A71]">
        
        {{-- Opsi "Tampilkan Semua" --}}
        <option value="" {{ request('category') == '' ? 'selected' : '' }}>Tampilkan Semua</option>

        @php
            $categories = \App\Models\Artwork::select('category')->distinct()->pluck('category');
        @endphp

        @foreach ($categories as $category)
            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                {{ $category }}
            </option>
        @endforeach
    </select>
</div>


            <!-- Filter Negara -->
            <div>
                <label for="country" class="block text-[#424242] font-medium mb-1">Asal</label>
                <select id="country" name="country"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#6B7A71] focus:border-[#6B7A71]">
                    <option value="">-- Pilih Negara --</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->origin }}" {{ request('country') == $country->origin ? 'selected' : '' }}>
                            {{ $country->origin }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        <!-- Tombol Filter dan Reset -->
        <div class="mt-6 flex flex-col md:flex-row md:justify-end gap-3">
            <button type="submit"
                class="flex items-center justify-center gap-2 bg-[#4D5D53] hover:bg-[#3A4A40] text-white font-semibold px-6 py-2 rounded-md transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Filter
            </button>
            <a href="{{ route('gallery') }}"
                class="flex items-center justify-center gap-2 bg-gray-400 hover:bg-gray-500 text-white font-semibold px-6 py-2 rounded-md transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 10l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Reset
            </a>
        </div>
    </form>

    <!-- Menampilkan Hasil Pencarian -->
    @if ($artworks->isEmpty())
        <div
            class="bg-white rounded-lg shadow-md p-12 text-center text-[#424242] max-w-xl mx-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-4 h-16 w-16 text-gray-400" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 16l4-4-4-4m8 8l-4-4 4-4" />
            </svg>
            <p class="text-lg">Tidak ada data yang ditampilkan. Silakan gunakan fitur pencarian atau filter di atas.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach ($artworks as $artwork)
                <div
                    class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 flex flex-col h-full">
                    @if ($artwork->image)
                        <img src="{{ asset('storage/images/' . $artwork->image) }}" alt="{{ $artwork->name }}"
                            class="h-48 w-full object-cover border-b-4 border-[#6B7A71]" />
                    @else
                        <img src="https://via.placeholder.com/300x200?text=No+Image" alt="No Image"
                            class="h-48 w-full object-cover border-b-4 border-[#6B7A71]" />
                    @endif

                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-[#3A4A40] font-semibold text-lg truncate" title="{{ $artwork->name }}">
                            {{ $artwork->name }}</h3>
                        <p class="text-gray-700 mb-3"><strong>Pembuat:</strong> {{ $artwork->creator ?? '-' }}</p>
                        <span
                            class="inline-block bg-[#EFEEF0] text-[#4D5D53] border border-[#6B7A71] rounded-full px-4 py-1 text-sm font-medium mb-auto">
                            {{ $artwork->category }}</span>
                        <a href="{{ route('artworks.detail', $artwork->id) }}"
                            class="mt-5 inline-block w-full text-center bg-[#4D5D53] hover:bg-[#3A4A40] text-white py-2 rounded-md font-semibold transition">
                          
                            Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
