<x-app-layout>
@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">
    <h2 class="text-3xl font-semibold text-green-900 mb-8 border-b-4 border-green-700 inline-block pb-2">
        Paling Banyak Difavoritkan
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @foreach ($mostFavorited as $artwork)
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <a href="{{ route('artworks.detail', $artwork->id) }}" class="block relative group">
                <img src="{{ asset('storage/images/' . $artwork->image) }}" alt="{{ $artwork->name }}" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                <div class="absolute top-3 right-3 bg-green-800 text-white text-xs font-semibold rounded-full px-3 py-1">
                    {{ $artwork->favorited_by_count }} Favorit
                </div>
            </a>
            <div class="p-4">
                <h3 class="text-lg font-semibold text-green-900 mb-1">{{ $artwork->name }}</h3>
                <p class="text-sm text-gray-700">{{ $artwork->creator }} - {{ $artwork->year }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
</x-app-layout>
