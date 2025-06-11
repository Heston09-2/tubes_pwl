<x-app-layout>
    @section('content')
    <div class="max-w-2xl mx-auto py-10 px-4">
        <h2 class="text-3xl font-semibold text-[#2c5c32] mb-8 text-center">Pesan Tiket</h2>

        <form action="{{ route('tickets.fillNames') }}" method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-6">
            @csrf

            <div>
                <label for="quantity" class="block text-gray-700 font-medium mb-2">Jumlah Tiket</label>
                <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" min="1" required
                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#50675d] focus:border-[#50675d] transition" />
                @error('quantity')
                    <p class="text-red-600 mt-2 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-[#50675d] hover:bg-[#3a4d44] text-white font-semibold py-3 px-4 rounded-md transition-transform transform hover:-translate-y-1 shadow">
                Lanjutkan
            </button>
        </form>

        <div class="mt-8 text-center">
            <a href="{{ route('tickets.my') }}" class="inline-block text-[#50675d] hover:underline font-medium transition">
                Lihat Riwayat Pemesanan
            </a>
        </div>
    </div>
    @endsection
</x-app-layout>
