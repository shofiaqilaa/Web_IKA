@extends('layout.app')

@section('content')
<div class="card">
  <div class="card-header bg-warning text-white">
    <h3 class="card-title">Edit Data Perusahaan</h3>
  </div>
  <div class="card-body">
    <form action="{{ route('perusahaan.update', $perusahaan->id_perusahaan) }}" method="POST" enctype="multipart/form-data">
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
        <label>Lokasi</label>
        <input type="text" name="lokasi" class="form-control" value="{{ $perusahaan->lokasi }}">
      </div>
      <div class="form-group">
        <label>Kontak</label>
        <input type="text" name="kontak_perusahaan" class="form-control" value="{{ $perusahaan->kontak_perusahaan }}" required>
      </div>
      <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi_perusahaan" class="form-control" required>{{ $perusahaan->deskripsi_perusahaan }}</textarea>
      </div>
      <div class="form-group">
        <label>Rating (0-5)</label>
        <input type="number" name="rating" class="form-control" step="0.1" min="0" max="5" value="{{ $perusahaan->rating }}">
      </div>
      <div class="form-group">
        <label>Logo Perusahaan</label>
        @if($perusahaan->logo)
          <div class="mb-2">
            <img src="{{ asset($perusahaan->logo) }}" alt="Logo" width="120">
          </div>
        @endif
        <input type="file" name="logo" class="form-control" accept="image/*">
      </div>
      <div class="form-group">
        <label>Tentang Kami</label>
        <textarea name="tentang_kami" class="form-control">{{ $perusahaan->tentang_kami }}</textarea>
      </div>
      <div class="form-group">
        <label>Visi</label>
        <textarea name="visi" class="form-control">{{ $perusahaan->visi }}</textarea>
      </div>
      <div class="form-group">
        <label>Misi</label>
        <textarea name="misi" class="form-control">{{ $perusahaan->misi }}</textarea>
      </div>
      <button type="submit" class="btn btn-warning">Update</button>
      <a href="{{ route('perusahaan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>
@endsection
