@extends('layout.app')

@section('content')
<div class="card">
  <div class="card-header bg-success text-white">
    <h3 class="card-title">Tambah Galeri Usaha</h3>
  </div>
  <div class="card-body">
    {{-- Form utama --}}
    <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control" required value="{{ old('judul') }}">
      </div>

      <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi') }}</textarea>
      </div>

      <div class="mb-3">
        <label>Upload Gambar</label>
        <input type="file" name="gambar" class="form-control" accept="image/*" required>
      </div>

      <div class="mb-3">
        <label>Alumni</label>
        <select name="id_alumni" class="form-control" required>
          <option value="">-- Pilih Alumni --</option>
          @foreach ($alumnis as $alumni)
            <option value="{{ $alumni->id }}">{{ $alumni->nama }}</option>
          @endforeach
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>
</div>
@endsection
