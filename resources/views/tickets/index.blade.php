<x-app-layout>

    @section('content')
    <div class="max-w-4xl mx-auto px-4 py-10">
        <h2 class="text-3xl font-semibold text-[#2c5c32] mb-6 text-center">Daftar Tiket Saya</h2>

        @if($tickets->count() > 0)
            <ul class="space-y-4">
                @foreach($tickets as $ticket)
                    <li class="bg-white shadow-md rounded-md p-5 flex flex-col sm:flex-row sm:justify-between sm:items-center border border-gray-200">
                        <div class="text-gray-800">
                            <p class="font-medium">Tiket #{{ $ticket->id }}</p>
                            <p>Jumlah: <span class="font-semibold">{{ $ticket->quantity }}</span></p>
                            <p>Waktu Pemesanan: <span class="text-sm text-gray-600">{{ $ticket->created_at->format('d M Y, H:i') }}</p>
                            
                            
                            <p>Total: <span class="font-semibold text-[#50675d]">Rp {{ number_format($ticket->total_price, 0, ',', '.') }}</span></p>
                        </div>
                        <div class="mt-3 sm:mt-0">
                            <a href="{{ route('tickets.download', $ticket->id) }}"
                               class="inline-block bg-[#50675d] hover:bg-[#3a4d44] text-white px-4 py-2 rounded-md font-medium shadow transition-transform transform hover:-translate-y-1">
                                Download PDF
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-center text-gray-600 mt-10">Anda belum memiliki tiket.</p>
        @endif
    </div>
    @endsection

</x-app-layout>
