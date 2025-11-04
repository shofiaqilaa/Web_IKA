@extends('layout.app')

@section('content')
<h1>Tambah Galeri</h1>

<form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Judul</label>
    <input type="text" name="judul" value="{{ old('judul') }}"><br>

    <label>Deskripsi</label>
    <textarea name="deskripsi">{{ old('deskripsi') }}</textarea><br>

    <label>Gambar</label>
    <input type="file" name="gambar"><br>

    <label>Alumni</label>
    <select name="id_alumni">
        @foreach($alumnis as $alumni)
            <option value="{{ $alumni->id }}">{{ $alumni->nama }}</option>
        @endforeach
    </select><br>

    <button type="submit">Simpan</button>
</form>
@endsection
