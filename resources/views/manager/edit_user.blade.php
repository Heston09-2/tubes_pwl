@extends('manager.layout.layout_manager')
@section('content')

<h1 class="text-2xl font-semibold mb-6">Edit Pengguna</h1>

<form action="{{ route('manager.users.update', $user->id) }}" method="POST" class="max-w-md space-y-6">
    @csrf
    @method('PUT')
    
    <div>
        <label class="block mb-1 font-medium text-gray-700">Nama:</label>
        <input 
            type="text" 
            name="name" 
            value="{{ $user->name }}" 
            required 
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
        >
    </div>
    
    <div>
        <label class="block mb-1 font-medium text-gray-700">Email:</label>
        <input 
            type="email" 
            name="email" 
            value="{{ $user->email }}" 
            required 
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
        >
    </div>
    
    <div>
        <label class="block mb-1 font-medium text-gray-700">Password (kosongkan jika tidak diubah):</label>
        <input 
            type="password" 
            name="password" 
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
        >
    </div>
    
    <div>
        <label class="block mb-1 font-medium text-gray-700">Role:</label>
        <select 
            name="role" 
            required 
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
        >
            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
    </div>

    <div class="flex items-center space-x-4">
        <button 
            type="submit" 
            class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition-colors"
        >
            Update
        </button>
        <a href="{{ route('manager.users') }}" class="text-gray-600 hover:underline">← Kembali</a>
    </div>
</form>

@endsection
