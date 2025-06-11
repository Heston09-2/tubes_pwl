@extends('manager.layout.layout_manager')
@section('content')

<h1 class="text-2xl font-semibold mb-6">Dashboard Manajer</h1>
<p class="mb-8 text-gray-700">Selamat datang, {{ Auth::user()->name }}!</p>

@if($notifications->isEmpty())
    <p class="text-gray-500 italic">Tidak ada notifikasi baru.</p>
@else
    <div class="space-y-6">
        @foreach ($notifications as $notification)
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-5 hover:shadow-md transition-shadow duration-200">
                <p class="font-semibold text-gray-900 mb-3">{{ $notification->message }}</p>

                <div class="text-sm text-gray-700 space-y-2">
                    @if($notification->ticket)
                        @if(is_array($notification->ticket->names))
                            <p class="font-semibold mt-3">Nama Pengunjung:</p>
                            <ul class="list-disc list-inside ml-5 space-y-1">
                                @foreach ($notification->ticket->names as $visitor)
                                    <li>{{ $visitor }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <p class="mt-3"><span class="font-semibold">Jumlah Tiket:</span> {{ $notification->ticket->quantity }}</p>
                        <p><span class="font-semibold">Total Harga:</span> Rp{{ number_format($notification->ticket->total_price, 0, ',', '.') }}</p>
                    @else
                        <p class="text-gray-500 italic">Tidak ada data tiket terkait.</p>
                    @endif

                    <p class="text-xs text-gray-400 mt-1 italic">{{ $notification->created_at->diffForHumans() }}</p>
                </div>

                <form action="{{ route('manager.notifications.destroy', $notification->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus notifikasi ini?');" class="mt-5">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-semibold transition-colors duration-150">
                        Hapus Notifikasi
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endif

@endsection
