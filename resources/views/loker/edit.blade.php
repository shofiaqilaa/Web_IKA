@extends('layout.app')

@section('content')
<div class="card">
  <div class="card-header bg-warning text-white">
    <h3 class="card-title">Edit Galeri Usaha</h3>
  </div>
  <div class="card-body">
    <form action="{{ route('galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control" value="{{ $galeri->judul }}" required>
      </div>

      <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="4" required>{{ $galeri->deskripsi }}</textarea>
      </div>

      <div class="mb-3">
        <label>Gambar</label>
        @if($galeri->gambar)
          <div class="mb-2">
            <img src="{{ asset('storage/' . $galeri->gambar) }}" alt="Gambar Galeri" width="150">
          </div>
        @endif
        <input type="file" name="gambar" class="form-control" accept="image/*">
      </div>

      <div class="mb-3">
        <label>Alumni</label>
        <select name="id_alumni" class="form-control" required>
          @foreach($alumnis as $alumni)
            <option value="{{ $alumni->id }}" {{ $galeri->id_alumni == $alumni->id ? 'selected' : '' }}>
              {{ $alumni->nama }}
            </option>
          @endforeach
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
  </div>
</div>
@endsection
