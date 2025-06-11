<x-app-layout>
    @section('content')
    <div class="max-w-[1200px] mx-auto p-8 bg-[#f5f7f5]">
        <h2 class="text-3xl font-medium text-[#2c3e50] mb-8 border-b-4 border-[#4a7c59] pb-3 inline-block">
            Daftar Favorit Anda
        </h2>

        @if (session('success'))
            <p class="text-green-600 mb-6">{{ session('success') }}</p>
        @endif

        @if ($favorites->isEmpty())
            <p class="text-[#4a7c59] text-lg">Belum ada favorit.</p>
        @else
            <ul class="space-y-8">
                @foreach ($favorites as $artwork)
                    <li class="flex flex-col md:flex-row items-center md:items-start bg-white rounded-lg shadow-md border border-gray-200 p-6">
                        <a href="{{ route('artworks.detail', $artwork->id) }}" class="block w-40 flex-shrink-0 mb-4 md:mb-0 md:mr-6 rounded overflow-hidden border border-gray-300 hover:shadow-lg transition-shadow duration-300">
                            <img src="{{ asset('storage/images/' . $artwork->image) }}" alt="{{ $artwork->name }}" class="w-full h-28 object-cover">
                        </a>
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-[#4a7c59] mb-1">{{ $artwork->name }}</h3>
                            <p class="text-[#2c3e50] mb-3">oleh {{ $artwork->creator }}</p>
                            <form action="{{ route('favorites.remove', $artwork->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-[#4a7c59] text-white px-4 py-2 rounded hover:bg-[#3a6a40] transition-colors duration-300">
                                    Hapus dari Favorit
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    @endsection
</x-app-layout>
