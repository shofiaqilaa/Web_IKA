@extends('layout.app')

@section('content')
<h1>Edit Galeri Usaha</h1>

<form action="{{ route('galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Judul</label>
    <input type="text" name="judul" value="{{ old('judul', $galeri->judul) }}"><br>

    <label>Deskripsi</label>
    <textarea name="deskripsi">{{ old('deskripsi', $galeri->deskripsi) }}</textarea><br>

    <label>Gambar Saat Ini</label><br>
    @if($galeri->gambar)
        <img src="{{ asset('storage/'.$galeri->gambar) }}" width="150"><br>
    @endif

    <label>Ganti Gambar (Opsional)</label>
    <input type="file" name="gambar"><br>

    <label>Alumni</label>
    <select name="id_alumni">
        @foreach($alumnis as $alumni)
            <option value="{{ $alumni->id }}" 
                {{ $galeri->id_alumni == $alumni->id ? 'selected' : '' }}>
                {{ $alumni->nama }}
            </option>
        @endforeach
    </select><br>

    <button type="submit">Update</button>
</form>
@endsection
