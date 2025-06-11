<x-app-layout>
    @section('content')
    <div class="max-w-6xl mx-auto px-4 py-10">
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-200 flex flex-col md:flex-row">
            {{-- Gambar --}}
            <div class="md:w-2/5 w-full">
                <div class="h-full w-full">
                    @if($artwork->image)
                        <img src="{{ asset('storage/images/' . $artwork->image) }}" alt="{{ $artwork->name }}" class="w-full h-full object-cover rounded-l-2xl">
                    @else
                        <img src="https://via.placeholder.com/600x400" alt="{{ $artwork->name }}" class="w-full h-full object-cover rounded-l-2xl">
                    @endif
                </div>
            </div>

            {{-- Detail --}}
            <div class="md:w-3/5 w-full p-8 bg-gray-50 flex flex-col justify-center rounded-r-2xl">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">{{ $artwork->name }}</h2>
                <p class="text-sm text-green-700 font-semibold mb-6 uppercase tracking-wider">{{ $artwork->category }}</p>

                <div class="space-y-5 text-sm text-gray-700">
                    <div>
                        <h3 class="font-semibold text-gray-600">Pembuat</h3>
                        <p>{{ $artwork->creator ?? 'Tidak diketahui' }}</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-600">Tahun</h3>
                        <p>{{ $artwork->year }}</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-600">Asal</h3>
                        <p>{{ $artwork->origin }}</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-600">Deskripsi</h3>
                        <p class="text-justify">{{ $artwork->description }}</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-600">Jumlah View</h3>
                        <p>Jumlah Views: {{ $totalViews }}</p>
                    </div>
                </div>

                {{-- Favorit --}}
                <form action="{{ route('favorites.toggle', $artwork->id) }}" method="POST" class="mt-8">
                    @csrf
                    <button type="submit"
                        class="inline-block bg-green-900 hover:bg-green-800 text-white px-5 py-2.5 rounded-lg font-semibold transition duration-200">
                        @if(auth()->user()->favorites->contains($artwork->id))
                            Hapus dari Favorit
                        @else
                            Tambah ke Favorit
                        @endif
                    </button>
                </form>

                {{-- Tombol Kembali --}}
                <div class="mt-4">
                    <a href="{{ route('dashboard') }}"
                        class="inline-block bg-gray-600 hover:bg-gray-700 text-white px-5 py-2.5 rounded-lg font-medium transition duration-200">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
