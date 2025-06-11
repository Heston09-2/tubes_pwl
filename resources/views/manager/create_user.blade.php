@extends('manager.layout.layout_manager')

@section('content')

<h1 class="text-2xl font-semibold mb-6">Tambah Pengguna</h1>

<form action="{{ route('manager.users.store') }}" method="POST" class="space-y-5 bg-white shadow-md rounded p-6 w-full max-w-md">
    @csrf

    <div>
        <label class="block mb-1 text-sm font-medium text-gray-700">Nama</label>
        <input type="text" name="name" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-100">
    </div>

    <div>
        <label class="block mb-1 text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-100">
    </div>

    <div>
        <label class="block mb-1 text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-100">
    </div>

    <div>
        <label class="block mb-1 text-sm font-medium text-gray-700">Role</label>
        <select name="role" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-100">
            <option value="user">User</option>
            <option value="admin">Admin</option>
            <option value="manager">Manager</option>
        </select>
    </div>

    <div class="flex items-center justify-between">
        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700 transition">Simpan</button>
        <a href="{{ route('manager.users') }}" class="text-sm text-gray-600 hover:underline">← Kembali</a>
    </div>
</form>

@endsection
