<x-app-layout>
    @section('content')
    <div class="max-w-[1200px] mx-auto p-8 bg-[#f5f7f5]">
        <div class="text-center mb-8">
            <h1 class="inline-block text-3xl font-medium mb-10 text-[#2c3e50] tracking-wide border-b-4 border-[#4a7c59] pb-3">
                Kategori: {{ ucfirst($category) }}
            </h1>
        </div>

        <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 justify-items-center">
            @foreach($artworks as $artwork)
                <div class="w-full max-w-xs rounded-lg overflow-hidden bg-white shadow-md border border-gray-200 hover:shadow-lg hover:-translate-y-2 transition-transform duration-300 relative">
                    <a href="{{ route('artworks.detail', $artwork['id']) }}" class="block relative group">
                        @if(isset($artwork['image']))
                            <img src="{{ asset('storage/images/' . $artwork['image']) }}" alt="{{ $artwork['name'] }}" class="w-full h-60 object-cover border-b border-gray-200">
                        @else
                            <img src="https://via.placeholder.com/280x240?text=Artwork" alt="{{ $artwork['name'] ?? 'Artwork' }}" class="w-full h-60 object-cover border-b border-gray-200">
                        @endif
                        <span class="absolute top-4 right-4 bg-[#4a7c59cc] text-white text-xs font-semibold px-3 py-1 rounded-full tracking-wide">
                            {{ ucfirst($category) }}
                        </span>
                        <div class="text-center p-4 text-[#4a7c59] font-medium tracking-wide text-lg group-hover:underline">
                            {{ $artwork['name'] }}
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @endsection
</x-app-layout>
