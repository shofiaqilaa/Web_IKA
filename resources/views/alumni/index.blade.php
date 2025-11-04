@extends('layout.app')

@section('content')
<div class="card">
  <div class="card-header bg-primary text-white">
    <h3 class="card-title">Data Alumni</h3>
  </div>
  <div class="card-body">
    <a href="{{ route('alumni.create') }}" class="btn btn-success mb-3">
      <i class="fas fa-plus"></i> Tambah Data
    </a>
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>Nama</th>
          <th>Nomor KTA</th>
          <th>Tahun Lulus</th>
          <th>Jurusan</th>
          <th>Prodi</th>
          <th>Username</th>
          <th>Password (hash)</th>

          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($alumni as $a)
        <tr>
          <td>{{ $a->nama_alumni }}</td>
          <td>{{ $a->nomor_kta }}</td>
          <td>{{ $a->tahun_lulus }}</td>
          <td>{{ $a->jurusan_alumni }}</td>
          <td>{{ $a->prodi_alumni }}</td>
          <td>{{ $a->username }}</td>
          <td>{{ Str::limit($a->password, 10, '...') }}</td>

          <td>
            <a href="{{ route('alumni.edit', $a->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('alumni.destroy', $a->id) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')">Hapus</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
