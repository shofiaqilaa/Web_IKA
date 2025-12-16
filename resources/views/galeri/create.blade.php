@extends('layout.app')

@section('content')
<div class="container">
    <h2>Tambah Galeri</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Perhatian!</strong> Ada kesalahan pada inputan.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Judul Usaha</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required>{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Pemilik/Alumni</label>
            <select name="id_alumni" class="form-control" required>
                <option value="">-- Pilih Alumni --</option>
                @foreach($alumnis as $alumni)
                    <option value="{{ $alumni->id }}" {{ old('id_alumni') == $alumni->id ? 'selected' : '' }}>
                        {{ $alumni->nama_lengkap }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Logo/Foto (jpg/png)</label>
            <input type="file" name="foto" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('galeri.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection