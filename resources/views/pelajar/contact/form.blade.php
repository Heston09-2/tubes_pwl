@extends('pelajar.layouts.app')
@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white shadow p-6 rounded">
    <h2 class="text-2xl font-bold mb-4">Hubungi Kami</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('pelajar.contact.submit') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium">Nama</label>
            <input type="text" value="{{ $pelajar->name }}" readonly class="w-full bg-gray-100 p-2 rounded border">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Email</label>
            <input type="email" value="{{ $pelajar->email }}" readonly class="w-full bg-gray-100 p-2 rounded border">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Pertanyaan</label>
            <textarea name="message" rows="5" class="w-full p-2 border rounded" required>{{ old('message') }}</textarea>
            @error('message')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Kirim
        </button>
    </form>
</div>
@endsection
