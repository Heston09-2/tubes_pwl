<x-app-layout>

    @section('content')
    <div class="max-w-3xl mx-auto py-10 px-4">
        <h2 class="text-3xl font-semibold text-[#2c5c32] mb-8 text-center">Isi Nama Pengunjung</h2>

        <form action="{{ route('tickets.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-6">
            @csrf
            <input type="hidden" name="quantity" value="{{ $quantity }}">

            <div class="space-y-4">
                @for($i = 0; $i < $quantity; $i++)
                    <div>
                        <label for="names[{{ $i }}]" class="block text-gray-700 font-medium mb-1">
                            Nama Pengunjung {{ $i + 1 }}
                        </label>
                        <input type="text" name="names[]" id="names[{{ $i }}]"
                               value="{{ old('names.' . $i) }}"
                               class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#50675d] focus:border-[#50675d] transition"
                               required>
                        @error("names.$i")
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @endfor
            </div>

            <button type="submit"
                    class="w-full bg-[#50675d] hover:bg-[#3a4d44] text-white font-semibold py-3 px-4 rounded-md transition-transform transform hover:-translate-y-1 shadow">
                Pesan Tiket
            </button>
        </form>
    </div>
    @endsection

</x-app-layout>
