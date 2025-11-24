@extends('layout.app')

@section('content')
<div class="card">
  <div class="card-header bg-success text-white">
    <h3 class="card-title">Tambah Loker</h3>
  </div>
  <div class="card-body">

    <form action="{{ route('loker.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label>Judul Loker</label>
        <input type="text" name="judul_loker" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Deskripsi Loker</label>
        <textarea name="deskripsi_loker" class="form-control" rows="4" required></textarea>
      </div>

      <div class="mb-3">
        <label>Perusahaan</label>
        <select name="id_perusahaan" class="form-control" required>
          <option value="">-- Pilih Perusahaan --</option>
          @foreach ($perusahaan as $p)
            <option value="{{ $p->id_perusahaan }}">{{ $p->nama_perusahaan }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label>Upload Gambar</label>
        <input type="file" name="gambar" class="form-control" accept="image/*">
      </div>

      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>
</div>
@endsection
