@extends('layout.app')

@section('content')
<div class="card">
  <div class="card-header bg-success text-white">
    <h3 class="card-title">Tambah Perusahaan</h3>
  </div>
  <div class="card-body">
    <form action="{{ route('perusahaan.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label>Nama Perusahaan</label>
        <input type="text" name="nama_perusahaan" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Alamat</label>
        <textarea name="alamat_perusahaan" class="form-control" required></textarea>
      </div>
      <div class="form-group">
        <label>Lokasi</label>
        <input type="text" name="lokasi" class="form-control">
      </div>
      <div class="form-group">
        <label>Kontak</label>
        <input type="text" name="kontak_perusahaan" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi_perusahaan" class="form-control" required></textarea>
      </div>
      <div class="form-group">
        <label>Rating (0-5)</label>
        <input type="number" name="rating" class="form-control" step="0.1" min="0" max="5">
      </div>
      <div class="form-group">
        <label>Logo Perusahaan</label>
        <input type="file" name="logo" class="form-control" accept="image/*">
      </div>
      <div class="form-group">
        <label>Tentang Kami</label>
        <textarea name="tentang_kami" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <label>Visi</label>
        <textarea name="visi" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <label>Misi</label>
        <textarea name="misi" class="form-control"></textarea>
      </div>
      <button type="submit" class="btn btn-success">Simpan</button>
      <a href="{{ route('perusahaan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>
@endsection
