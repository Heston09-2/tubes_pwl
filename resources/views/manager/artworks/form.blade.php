@extends('manager.layout.layout_manager')
@section('content')


<p>
    <label>Nama:</label><br>
    <input type="text" name="name" value="{{ old('name', $artwork->name ?? '') }}" required>
</p>

<p>
    <label>Kategori:</label><br>
    <input type="text" name="category" value="{{ old('category', $artwork->category ?? '') }}" required>
</p>

<p>
    <label>Pembuat:</label><br>
    <input type="text" name="creator" value="{{ old('creator', $artwork->creator ?? '') }}" required>
</p>

<p>
    <label>Tahun:</label><br>
    <input type="number" name="year" value="{{ old('year', $artwork->year ?? '') }}" required>
</p>

<p>
    <label>Asal:</label><br>
    <input type="text" name="origin" value="{{ old('origin', $artwork->origin ?? '') }}" required>
</p>

<p>
    <label>Deskripsi:</label><br>
    <textarea name="description" rows="4" required>{{ old('description', $artwork->description ?? '') }}</textarea>
</p>

<p>
    <label>Gambar:</label><br>
    <input type="file" name="image">
    @if(isset($artwork) && $artwork->image)
        <br><img src="{{ asset('storage/' . $artwork->image) }}" width="150">
    @endif
</p>
@ends