@extends('layout.app')

@section('content')
<div class="card">
  <div class="card-header bg-primary text-white">
    <h3 class="card-title">Data Loker</h3>
  </div>
  <div class="card-body">
    <a href="{{ route('loker.create') }}" class="btn btn-success mb-3">
      <i class="fas fa-plus"></i> Tambah Loker
    </a>
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>Judul Loker</th>
          <th>Deskripsi</th>
          <th>Perusahaan</th>
          <th>Gambar</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($loker as $l)
        <tr>
          <td>{{ $l->judul_loker }}</td>
          <td>{{ Str::limit($l->deskripsi_loker, 50) }}</td>
          <td>{{ $l->perusahaan->nama_perusahaan ?? '-' }}</td>
          <td>
  @if ($l->gambar)
      <img src="{{ asset($l->gambar) }}" width="100">
  @else
      <small>Tidak ada</small>
  @endif
</td>
          <td>
            <a href="{{ route('loker.edit', $l->id_loker) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('loker.destroy', $l->id_loker) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
