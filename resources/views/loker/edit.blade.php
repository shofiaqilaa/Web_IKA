@extends('layout.app')

@section('content')
<div class="card">
  <div class="card-header bg-warning text-white">
    <h3 class="card-title">Edit Loker</h3>
  </div>
  <div class="card-body">
    <form action="{{ route('loker.update', $loker->id_loker) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label>Judul Loker</label>
        <input type="text" name="judul_loker" class="form-control" value="{{ $loker->judul_loker }}" required>
      </div>

      <div class="mb-3">
        <label>Deskripsi Loker</label>
        <textarea name="deskripsi_loker" class="form-control" rows="4" required>{{ $loker->deskripsi_loker }}</textarea>
      </div>

      <div class="mb-3">
        <label>Perusahaan</label>
        <select name="id_perusahaan" class="form-control" required>
          <option value="">-- Pilih Perusahaan --</option>
          @foreach ($perusahaan as $p)
            <option value="{{ $p->id_perusahaan }}" {{ $loker->id_perusahaan == $p->id_perusahaan ? 'selected' : '' }}>{{ $p->nama_perusahaan }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label>Gambar</label>
        @if ($loker->gambar)
          <div class="mb-2">
            <img src="{{ asset($loker->gambar) }}" alt="Gambar Loker" width="150">
          </div>
        @endif
        <input type="file" name="gambar" class="form-control" accept="image/*">
      </div>

      <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
  </div>
</div>
@endsection
