@extends('pelajar.layouts.app') {{-- Layout utama pelajar --}}

@section('title', 'Profil Saya')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">

    <h2 class="text-2xl font-semibold text-sky-700 mb-4">Profil Saya</h2>

    <div class="space-y-2 text-gray-800">
        <p><span class="font-semibold">Nama:</span> {{ $pelajar->name }}</p>
        <p><span class="font-semibold">Email:</span> {{ $pelajar->email }}</p>
        <p><span class="font-semibold">Umur:</span> {{ $pelajar->umur }}</p>
        <p><span class="font-semibold">Pendidikan:</span> {{ $pelajar->pendidikan }}</p>
        
    </div>

    <div class="mt-6">
        <a href="{{ route('pelajar.profile.edit') }}"
           class="inline-block bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded transition">
            Edit Profil
        </a>
    </div>
</div>
@endsection
