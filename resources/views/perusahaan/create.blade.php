@extends('layout.app')

@section('content')
<div class="card">
  <div class="card-header bg-success text-white">
    <h3 class="card-title">Tambah Perusahaan</h3>
  </div>
  <div class="card-body">
    <form action="{{ route('perusahaan.store') }}" method="POST">
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
        <label>Kontak</label>
        <input type="text" name="kontak_perusahaan" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi_perusahaan" class="form-control" required></textarea>
      </div>
      <button type="submit" class="btn btn-success">Simpan</button>
      <a href="{{ route('perusahaan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>
@endsection
