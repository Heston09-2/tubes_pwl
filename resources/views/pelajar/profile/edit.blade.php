@extends('pelajar.layouts.app') {{-- Layout utama aplikasi --}}

@section('title', 'Edit Profil')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">

    {{-- Tombol kembali --}}
    <div class="mb-4">
        <a href="{{ route('pelajar.home') }}" class="text-sky-600 hover:underline text-sm">&larr; Kembali ke Halaman Utama</a>
    </div>

    <h2 class="text-2xl font-semibold text-sky-700 mb-4">Edit Profil</h2>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Edit --}}
    <form action="{{ route('pelajar.profile.update') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium text-gray-700">Nama</label>
            <input type="text" name="name" value="{{ old('name', $pelajar->name) }}" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-sky-300">
        </div>

        <div>
            <label class="block font-medium text-gray-700">Umur</label>
            <input type="number" name="umur" value="{{ old('umur', $pelajar->umur) }}" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-sky-300">
        </div>

        <div>
            <label class="block font-medium text-gray-700">Pendidikan</label>
            <select name="pendidikan" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-sky-300">
                <option value="SD" {{ $pelajar->pendidikan == 'SD' ? 'selected' : '' }}>SD</option>
                <option value="SMP" {{ $pelajar->pendidikan == 'SMP' ? 'selected' : '' }}>SMP</option>
                <option value="SMA" {{ $pelajar->pendidikan == 'SMA' ? 'selected' : '' }}>SMA</option>
            </select>
        </div>
        <div>
    <label class="block font-medium text-gray-700">Password Lama <span class="text-red-500">*</span></label>
    <input type="password" name="current_password"
           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-sky-300"
           placeholder="Masukkan password lama jika ingin mengganti password">
    @error('current_password')
        <small class="text-red-500">{{ $message }}</small>
    @enderror
</div>


        <div>
            <label class="block font-medium text-gray-700">Ganti Password (opsional)</label>
            <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengganti"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-sky-300">
        </div>

        <div>
            <label class="block font-medium text-gray-700">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-sky-300">
        </div>

        <div class="pt-2">
            <button class="bg-sky-600 text-white px-4 py-2 rounded hover:bg-sky-700 transition">
                Simpan Perubahan
            </button>
        </div>
    </form>

    {{-- Form Hapus Akun --}}
    <hr class="my-6">

    <h3 class="text-xl text-red-600 font-semibold mb-2">Hapus Akun</h3>
    <form action="{{ route('pelajar.profile.delete') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun ini?')">
        @csrf
        <div class="mb-3">
            <label class="block font-medium text-gray-700">Masukkan Password untuk Konfirmasi</label>
            <input type="password" name="password"
                   class="w-full border border-red-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-red-300"
                   required>
            @error('password')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
            Hapus Akun
        </button>
    </form>
</div>
@endsection
