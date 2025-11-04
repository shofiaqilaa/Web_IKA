@extends('layout.app')

@section('content')
<div class="container">
    <h2>Tambah Data Alumni</h2>

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

    <form action="{{ route('alumni.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_alumni" class="form-label">Nama Alumni</label>
            <input type="text" name="nama_alumni" class="form-control" value="{{ old('nama_alumni') }}" required>
        </div>

        <div class="mb-3">
            <label for="nomor_kta" class="form-label">Nomor KTA</label>
            <input type="text" name="NIM" class="form-control" value="{{ old('NIM') }}" required>
        </div>

        <div class="mb-3">
            <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
            <input type="number" name="tahun_lulus" class="form-control" value="{{ old('tahun_lulus') }}" required>
        </div>

        <div class="mb-3">
            <label for="jurusan_alumni" class="form-label">Jurusan</label>
            <input type="text" name="jurusan_alumni" class="form-control" value="{{ old('jurusan_alumni') }}" required>
        </div>

        <div class="mb-3">
            <label for="prodi_alumni" class="form-label">Program Studi</label>
            <input type="text" name="prodi_alumni" class="form-control" value="{{ old('prodi_alumni') }}" required>
        </div>
        <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" name="username" id="username" class="form-control" required>
    </div>

    <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" id="password" class="form-control" required>
    </div>


        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('alumni.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
