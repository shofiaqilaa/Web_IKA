@extends('layout.app')

@section('content')
<h1>Tambah Galeri</h1>

<form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Judul Usaha</label>
    <input type="text" name="judul" value="{{ old('judul') }}" required><br>

    <label>Deskripsi</label>
    <textarea name="deskripsi" required>{{ old('deskripsi') }}</textarea><br>

    <label>Nama Pemilik/Alumni</label>
    <input type="text" name="nama_alumni" value="{{ old('nama_alumni') }}" required><br>

    <label>Gambar Logo/Foto</label>
    <input type="file" name="foto" required><br>

    <button type="submit">Simpan</button>
</form>
@endsection