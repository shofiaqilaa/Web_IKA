@extends('layout.app')

@section('content')
<div class="card">
  <div class="card-header bg-warning text-white">
    <h3 class="card-title">Edit Data Perusahaan</h3>
  </div>
  <div class="card-body">
    <form action="{{ route('perusahaan.update', $perusahaan->id_perusahaan) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label>Nama Perusahaan</label>
        <input type="text" name="nama_perusahaan" class="form-control" value="{{ $perusahaan->nama_perusahaan }}" required>
      </div>
      <div class="form-group">
        <label>Alamat</label>
        <textarea name="alamat_perusahaan" class="form-control" required>{{ $perusahaan->alamat_perusahaan }}</textarea>
      </div>
      <div class="form-group">
        <label>Kontak</label>
        <input type="text" name="kontak_perusahaan" class="form-control" value="{{ $perusahaan->kontak_perusahaan }}" required>
      </div>
      <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi_perusahaan" class="form-control" required>{{ $perusahaan->deskripsi_perusahaan }}</textarea>
      </div>
      <button type="submit" class="btn btn-warning">Update</button>
      <a href="{{ route('perusahaan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>
@endsection
