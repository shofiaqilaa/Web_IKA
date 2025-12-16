@extends('layout.app')

@section('content')
<h1>Galeri Usaha Alumni</h1>

<a href="{{ route('galeri.create') }}" class="btn btn-primary mb-3">Tambah Galeri</a>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Pemilik Usaha</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($galeris as $galeri)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                @if($galeri->foto)
                    <img src="{{ asset('storage/'.$galeri->foto) }}" width="100" alt="{{ $galeri->judul }}">
                @else
                    <span class="badge bg-secondary">Tidak ada gambar</span>
                @endif
            </td>
            <td>{{ $galeri->judul }}</td>
            <td>{{ Str::limit($galeri->deskripsi, 50) }}</td>
            <td>
                @if($galeri->alumni)
                    <strong>{{ $galeri->alumni->nama_lengkap }}</strong><br>
                    <small class="text-muted">Angkatan {{ $galeri->alumni->angkatan }}</small>
                @else
                    <span class="badge bg-warning">Belum ada pemilik</span>
                @endif
            </td>
            <td>
                <a href="{{ route('galeri.edit', $galeri->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Belum ada data galeri</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection