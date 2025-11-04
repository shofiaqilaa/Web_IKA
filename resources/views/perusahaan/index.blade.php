@extends('layout.app')

@section('content')
<div class="card">
  <div class="card-header bg-primary text-white">
    <h3 class="card-title">Data Perusahaan</h3>
  </div>
  <div class="card-body">
    <a href="{{ route('perusahaan.create') }}" class="btn btn-success mb-3">
      <i class="fas fa-plus"></i> Tambah Perusahaan
    </a>

    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>Nama Perusahaan</th>
          <th>Alamat</th>
          <th>Kontak</th>
          <th>Deskripsi</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($perusahaan as $p)
        <tr>
          <td>{{ $p->nama_perusahaan }}</td>
          <td>{{ $p->alamat_perusahaan }}</td>
          <td>{{ $p->kontak_perusahaan }}</td>
          <td>{{ $p->deskripsi_perusahaan }}</td>
          <td>
            <a href="{{ route('perusahaan.edit', $p->id_perusahaan) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('perusahaan.destroy', $p->id_perusahaan) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
