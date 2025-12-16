@extends('layout.app')

@section('content')
<div class="card">
    <div class="card-header bg-warning text-white">
        <h3 class="card-title">Edit Galeri Usaha</h3>
    </div>
    <div class="card-body">
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

        <form action="{{ route('galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul', $galeri->judul) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Alumni Pemilik Usaha</label>
                <select name="id_alumni" class="form-control" required>
                    <option value="">-- Pilih Alumni --</option>
                    @foreach($alumnis as $alumni)
                        <option value="{{ $alumni->id }}" 
                            {{ old('id_alumni', $galeri->id_alumni) == $alumni->id ? 'selected' : '' }}>
                            {{ $alumni->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Saat Ini</label>
                @if($galeri->foto)
                    <div class="mb-2">
                        <img src="{{ $galeri->foto_url ?? asset('storage/'.$galeri->foto) }}" alt="Gambar Galeri" width="150">
                    </div>
                @endif
                <label class="form-label">Ganti Gambar (Opsional)</label>
                <input type="file" name="foto" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('galeri.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection