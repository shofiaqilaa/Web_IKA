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

        <!-- Nama Lengkap -->
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control"
                value="{{ old('nama_lengkap', $alumni->nama_lengkap) }}" required>
        </div>

        <!-- Angkatan Kuliah -->
        <div class="mb-3">
            <label class="form-label">Angkatan Kuliah</label>
            <input type="number" name="angkatan" class="form-control"
                value="{{ old('angkatan', $alumni->angkatan) }}" required>
        </div>

        <!-- Jurusan -->
        <div class="mb-3">
            <label class="form-label">Jurusan</label>
            <input type="text" name="jurusan" class="form-control"
                value="{{ old('jurusan', $alumni->jurusan) }}" required>
        </div>

        <!-- Nomor WA -->
        <div class="mb-3">
            <label class="form-label">Nomor WA Aktif</label>
            <input type="text" name="no_wa" class="form-control"
                value="{{ old('no_wa', $alumni->no_wa) }}" required>
        </div>

        <!-- Alamat -->
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $alumni->alamat) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Perbarui</button>
        <a href="{{ route('alumni.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
