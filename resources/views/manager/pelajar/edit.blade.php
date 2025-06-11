@extends('manager.layout.layout_manager')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-8">
    <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Edit Pelajar</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('manager.pelajar.update', $pelajar->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $pelajar->nama) }}" required
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $pelajar->email) }}" required
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Password (kosongkan jika tidak ingin diubah)</label>
            <input type="password" name="password"
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="flex justify-between items-center mt-6">
            <a href="{{ route('manager.pelajar.index') }}"
               class="text-sm text-gray-600 hover:underline">← Kembali ke daftar pelajar</a>
            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg transition">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
