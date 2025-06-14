@extends('pelajar.layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Buat Topik Forum Baru</h1>

    <form action="{{ route('pelajar.forum.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label>Gambar (Opsional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Posting</button>
    </form>
</div>
@endsection
