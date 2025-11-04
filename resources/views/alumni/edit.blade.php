@extends('layout.app')

@section('content')
<div class="container">
    <h2>Edit Data Alumni</h2>

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

    <form action="{{ route('alumni.update', $alumni->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_alumni" class="form-label">Nama Alumni</label>
            <input type="text" name="nama_alumni" class="form-control" value="{{ old('nama_alumni', $alumni->nama_alumni) }}" required>
        </div>

        <div class="mb-3">
            <label for="nomor_kta" class="form-label">Nomor KTA</label>
            <input type="text" name="NIM" class="form-control" value="{{ old('NIM', $alumni->NIM) }}" required>
        </div>

        <div class="mb-3">
            <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
            <input type="number" name="tahun_lulus" class="form-control" value="{{ old('tahun_lulus', $alumni->tahun_lulus) }}" required>
        </div>

        <div class="mb-3">
            <label for="jurusan_alumni" class="form-label">Jurusan</label>
            <input type="text" name="jurusan_alumni" class="form-control" value="{{ old('jurusan_alumni', $alumni->jurusan_alumni) }}" required>
        </div>

        <div class="mb-3">
            <label for="prodi_alumni" class="form-label">Program Studi</label>
            <input type="text" name="prodi_alumni" class="form-control" value="{{ old('prodi_alumni', $alumni->prodi_alumni) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('alumni.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
