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

        <!-- Nama Lengkap -->
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}" required>
        </div>

        <!-- Angkatan Kuliah -->
        <div class="mb-3">
            <label class="form-label">Angkatan Kuliah</label>
            <input type="number" name="angkatan" class="form-control" value="{{ old('angkatan') }}" required>
        </div>

        <!-- Jurusan -->
        <div class="mb-3">
            <label class="form-label">Jurusan</label>
            <input type="text" name="jurusan" class="form-control" value="{{ old('jurusan') }}" required>
        </div>

        <!-- Nomor WhatsApp -->
        <div class="mb-3">
            <label class="form-label">Nomor WA Aktif</label>
            <input type="text" name="no_wa" class="form-control" value="{{ old('no_wa') }}" placeholder="08xxxxxxx" required>
        </div>

        <!-- Alamat -->
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('alumni.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
